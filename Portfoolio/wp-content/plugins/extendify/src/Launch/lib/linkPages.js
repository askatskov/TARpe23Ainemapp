import { rawHandler, getBlockContent } from '@wordpress/blocks';
import { pageNames } from '@shared/lib/pages';
import { getLinkSuggestions } from '@launch/api/DataApi';
import {
	getActivePlugins,
	getOption,
	getPageById,
	updatePage,
} from '@launch/api/WPApi';
import { wasInstalled } from '@launch/lib/util';

const { homeUrl } = window.extSharedData;
const buttonRegex = /href="(#extendify-[\w-]+)"/gi;
const pagesWithButtons = (p) => p?.content?.raw?.match(buttonRegex);

export const updateButtonLinks = async (wpPages, pluginPages) => {
	// Fetch active plugins after installing plugins
	let { data: activePlugins } = await getActivePlugins();
	const contactPageSlug = wpPages.find(({ originalSlug }) =>
		originalSlug.startsWith('contact'),
	)?.slug;

	const patternsToProcess = wpPages
		// Look for pages with links
		.filter(pagesWithButtons)
		.map(({ content }) => {
			// 1. Convert to individual blocks
			return (
				rawHandler({ HTML: content.raw || '' })
					// 2. Convert back to HTML
					.map((b) => getBlockContent(b))
					// 3. Filter only blocks with links
					.filter((b) => b.match(buttonRegex))
					.join('')
				// TODO: Filter out patterns from pages that have identical buttons?
			);
		});

	// Collect the page slugs to share with the server
	const availablePages = wpPages
		.concat(pluginPages)
		.filter(({ slug }) => !slug.startsWith('home'))
		.map(({ slug }) => `/${slug}`);

	// Add plugin related pages only if plugin is active
	if (wasInstalled(activePlugins, 'woocommerce')) {
		const shopPage = await getPageById(
			await getOption('woocommerce_shop_page_id'),
		);

		if (shopPage) {
			availablePages.push(`/${shopPage.slug}`);
		}
	}

	// Fetch the links from the server. If a request fails, ignore it.
	const suggestedLinks = (
		await Promise.allSettled(
			patternsToProcess.map(
				(pageContent) => getLinkSuggestions(pageContent, availablePages) || {},
			),
		)
	)
		.filter((r) => r.status === 'fulfilled')
		.map((r) => r.value?.suggestedLinks || [])
		// Combine all suggested links
		.reduce((acc, link) => ({ ...acc, ...link }), {});

	const linkKeys = Object.keys(suggestedLinks)
		.filter((k) =>
			// Remove links sent back that aren't in the availablePages
			availablePages.includes(`/${suggestedLinks[k].replace(/^\//, '')}`),
		)
		.map((v) => `\\"${v}\\"`)
		.join('|');

	// Replace links and update the pages. Failed pages get ignored.
	const newPages = (
		await Promise.allSettled(
			wpPages.filter(pagesWithButtons).map((p) => {
				// We want to match \"extendify-cta\" exactly inside the href
				// So we need to look for the quotes, then replace with the quotes
				const content = linkKeys
					? p.content.raw.replace(new RegExp(linkKeys, 'g'), (match) => {
							if (!match || suggestedLinks.length === 0) return '';

							const link = suggestedLinks[match.replace(/"/g, '')];
							// if the link points to the current page or '/'
							// we should link to the contact page (or default to '/')
							if ([p.slug, `/${p.slug}`, '/'].includes(link))
								return `"${homeUrl}/${contactPageSlug ?? ''}"`;

							// The server once sent back slugs without the /
							// so we need to check
							return `"${homeUrl}/${link.replace(/^\//, '')}"`;
						})
					: p.content.raw.replace(new RegExp(buttonRegex, 'g'), (match) => {
							return match ? 'href="#"' : '';
						});
				return updatePage({ id: p.id, content });
			}),
		)
	)
		.filter((r) => r.status === 'fulfilled')
		.map((r) => r.value);

	return (
		wpPages
			// Add the new pages into the wpPages array
			.map((p) => newPages.find(({ id }) => id === p.id) || p)
			// Also include the originalSlug from wpPages
			.map((p) => {
				const { originalSlug } = wpPages.find(({ id }) => id === p.id) || {};
				return { ...p, originalSlug };
			})
	);
};

export const updateSinglePageLinksToContactSection = async (wpPages, pages) => {
	// Find if there's a contact pattern in the single page's patterns
	const hasContactPattern = pages?.[0]?.patterns.find((p) =>
		p?.patternTypes?.[0]?.startsWith('contact'),
	);

	// Find if there's a products pattern in the single page's patterns
	const hasProductPattern = pages?.[0]?.patterns.find((p) =>
		p?.patternTypes?.[0]?.startsWith('product'),
	);

	// If there's a product pattern, update the shop page link
	if (hasProductPattern) {
		wpPages[0] = await updateShopLinks(wpPages[0]);
	}

	// Find if there's a blog pattern in the single page's patterns
	const hasBlogSectionPattern = pages?.[0]?.patterns.find((p) =>
		p?.patternTypes?.[0]?.startsWith('blog'),
	);

	// If there's a blog pattern, update the link to point to blog
	if (hasBlogSectionPattern) {
		wpPages[0] = await updateBlogLinks(hasBlogSectionPattern, wpPages[0]);
	}

	// If no contact pattern is found, return the original wpPages
	if (!hasContactPattern) return wpPages;

	// Get the translated slug
	const { slug } =
		Object.values(pageNames).find(({ alias }) =>
			alias.includes(hasContactPattern.patternTypes[0]),
		) || {};

	if (!slug) return wpPages;

	// Map through each WordPress page and update its content
	return wpPages.map((page) => {
		// Update each page by replacing the buttons urls with the new slug
		return updatePage({
			id: page.id,
			content: page.content.raw.replaceAll(
				/"#extendify-[\w-]+"/g,
				`"${homeUrl}/#${slug}"`,
			),
		});
	});
};

const updateShopLinks = async (page) => {
	// Fetch active plugins after installing plugins
	let { data } = await getActivePlugins();

	// Change the link to the shop page if it exists
	if (wasInstalled(data, 'woocommerce')) {
		const shopPage = await getPageById(
			await getOption('woocommerce_shop_page_id'),
		);

		if (shopPage) {
			return updatePage({
				id: page.id,
				content: page.content.raw.replaceAll(
					/"#extendify-shop"/g,
					`"${homeUrl}/${shopPage.slug}"`,
				),
			});
		}
	}

	return page;
};

const updateBlogLinks = (hasBlogSectionPattern, page) => {
	// Get the translated slug
	const { slug } =
		Object.values(pageNames).find(({ alias }) =>
			alias.includes(hasBlogSectionPattern.patternTypes[0]),
		) || {};

	if (!slug) return page;

	return updatePage({
		id: page.id,
		content: page.content.raw.replaceAll(
			/"#extendify-blog"/g,
			`"${homeUrl}/${slug}"`,
		),
	});
};
