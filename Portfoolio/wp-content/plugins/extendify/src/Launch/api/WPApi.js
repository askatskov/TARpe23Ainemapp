import apiFetch from '@wordpress/api-fetch';
import { __ } from '@wordpress/i18n';
import { pageNames } from '@shared/lib/pages';
import { Axios as api } from '@launch/api/axios';

const { wpRoot } = window.extOnbData;

export const updateOption = (option, value) =>
	api.post('launch/options', { option, value });

export const getOption = async (option) => {
	const { data } = await api.get('launch/options', {
		params: { option },
	});
	return data;
};

export const createPage = (pageData) =>
	api.post(`${wpRoot}wp/v2/pages`, pageData);

export const updatePage = (pageData) =>
	api.post(`${wpRoot}wp/v2/pages/${pageData.id}`, pageData);

export const getPageById = (pageId) =>
	api.get(`${wpRoot}wp/v2/pages/${pageId}`);

export const createPost = (postData) =>
	api.post(`${wpRoot}wp/v2/posts`, postData);

export const uploadMedia = (formData) =>
	api.post(`${wpRoot}wp/v2/media`, formData);

export const createCategory = (CategoryData) =>
	api.post(`${wpRoot}wp/v2/categories`, CategoryData);

export const createTag = (tagData) => api.post(`${wpRoot}wp/v2/tags`, tagData);

export const installPlugin = async (plugin) => {
	// Fail silently if no slug is provided
	if (!plugin?.wordpressSlug) return;

	await api.post(`${wpRoot}wp/v2/plugins`, {
		slug: plugin.wordpressSlug,
	});
};

export const activatePlugin = async (plugin) => {
	const endpoint = new URL(`${wpRoot}wp/v2/plugins`);
	const params = new URLSearchParams(endpoint.searchParams);
	params.set('search', plugin.wordpressSlug);
	endpoint.search = params.toString();
	const response = await api.get(endpoint.toString());
	const pluginSlug = response?.[0]?.plugin;
	if (!pluginSlug) {
		throw new Error('Plugin not found');
	}
	// Attempt to activate the plugin with the slug we found
	await api.post(`${wpRoot}wp/v2/plugins/${pluginSlug}`, {
		status: 'active',
	});
};

export const createNavigation = async (content = '') => {
	const payload = await apiFetch({
		path: 'extendify/v1/launch/create-navigation',
		method: 'POST',
		data: {
			title: __('Header Navigation', 'extendify-local'),
			slug: 'site-navigation',
			content,
		},
	});

	return payload.id;
};

export const updateNavigation = async (id, content) => {
	const payload = await apiFetch({
		path: `wp/v2/navigation/${id}`,
		method: 'POST',
		data: {
			content,
		},
	});

	return payload.id;
};

export const updateTemplatePart = (part, content) =>
	api.post(`${wpRoot}wp/v2/template-parts/${part}`, {
		slug: `${part}`,
		theme: 'extendable',
		type: 'wp_template_part',
		status: 'publish',
		// See: https://github.com/extendify/company-product/issues/833#issuecomment-1804179527
		// translators: Launch is the product name. Unless otherwise specified by the glossary, do not translate this name.
		description: __('Added by Launch', 'extendify-local'),
		content,
	});

const allowedHeaders = ['header', 'header-with-center-nav-and-social'];
const allowedFooters = [
	'footer',
	'footer-social-icons',
	'footer-with-center-logo-and-menu',
];

export const getHeadersAndFooters = async () => {
	let patterns = await getTemplateParts();
	patterns = patterns?.filter((p) => p.theme === 'extendable');
	const headers = patterns?.filter((p) => allowedHeaders.includes(p?.slug));
	const footers = patterns?.filter((p) => allowedFooters.includes(p?.slug));
	return { headers, footers };
};

const getTemplateParts = () => api.get(wpRoot + 'wp/v2/template-parts');

export const getThemeVariations = async () => {
	const variations = await api.get(
		wpRoot + 'wp/v2/global-styles/themes/extendable/variations',
	);

	if (!Array.isArray(variations)) {
		throw new Error('Could not get theme variations');
	}

	// Adds slug to match with color palettes from airtable
	const variationsWithSlugs = variations.map((variation) => {
		const slug =
			// The Fusion Sky variation is misspelled in Extendable, so it needs a special case.
			variation.title === 'FusionSky'
				? 'fusion-sky'
				: variation.title.toLowerCase().trim().replace(/\s+/, '-');

		return { ...variation, slug };
	});

	// Randomize
	return [...variationsWithSlugs].sort(() => Math.random() - 0.5);
};

export const updateThemeVariation = (id, variation) =>
	api.post(`${wpRoot}wp/v2/global-styles/${id}`, {
		id,
		settings: variation.settings,
		styles: variation.styles,
	});

export const addSectionLinksToNav = async (
	navigationId,
	homePatterns = [],
	pluginPages = [],
) => {
	// Extract plugin page slugs for comparison
	const pluginPageSlugs = pluginPages.map(({ slug }) => slug);

	// ['about-us', 'services', 'contact-us']
	const sections = homePatterns
		.map(({ patternTypes }) => patternTypes?.[0])
		.filter(Boolean)
		// Filter out any pattern type that has a page created by 3rd party plugins.
		.filter((patternType) => {
			const { slug } =
				Object.values(pageNames).find(({ alias }) =>
					alias.includes(patternType),
				) || {};
			return slug && !pluginPageSlugs.includes(slug);
		});

	const seen = new Set();

	const sectionsNavigationLinks = sections.map((patternType) => {
		const { title, slug } =
			Object.values(pageNames).find(({ alias }) =>
				alias.includes(patternType),
			) || {};
		if (!slug) return '';
		if (seen.has(slug)) return '';
		seen.add(slug);

		const attributes = JSON.stringify({
			label: title,
			type: 'custom',
			url: `${window.extSharedData.homeUrl}/#${slug}`,
			kind: 'custom',
			isTopLevelLink: true,
		});

		return `<!-- wp:navigation-link ${attributes} /-->`;
	});

	const pluginPagesNavigationLinks = pluginPages.map(
		({ title, id, type, link }) => {
			const attributes = JSON.stringify({
				label: title.rendered,
				id,
				type,
				url: link,
				kind: id ? 'post-type' : 'custom',
				isTopLevelLink: true,
			});

			return `<!-- wp:navigation-link ${attributes} /-->`;
		},
	);

	const navigationLinks = sectionsNavigationLinks
		.concat(pluginPagesNavigationLinks)
		.join('');

	await updateNavigation(navigationId, navigationLinks);
};

export const addPageLinksToNav = async (
	navigationId,
	allPages,
	createdPages,
	pluginPages = [],
) => {
	// Because WP may have changed the slug and permalink (i.e., because of different languages),
	// we are using the `originalSlug` property to match the original pages with the updated ones.
	const findCreatedPage = ({ slug }) =>
		createdPages.find(({ originalSlug: s }) => s === slug) || {};

	const filteredCreatedPages = allPages
		.filter((p) => findCreatedPage(p)?.id) // make sure its a page
		.filter(({ slug }) => slug !== 'home') // exclude home page
		.map((page) => findCreatedPage(page));

	const pageLinks = filteredCreatedPages
		.concat(pluginPages)
		.map(({ id, title, link, type }) => {
			const attributes = JSON.stringify({
				label: title.rendered,
				id,
				type,
				url: link,
				kind: id ? 'post-type' : 'custom',
				isTopLevelLink: true,
			});

			return `<!-- wp:navigation-link ${attributes} /-->`;
		});

	const topLevelLinks = pageLinks.slice(0, 5).join('');
	const submenuLinks = pageLinks.slice(5);
	// We want a max of 6 top-level links, but if 7+, then move the last
	// two+ to a submenu.
	const additionalLinks =
		submenuLinks.length > 1
			? ` <!-- wp:navigation-submenu ${JSON.stringify({
					// translators: "More" here is used for a navigation menu item that contains additional links.
					label: __('More', 'extendify-local'),
					url: '#',
					kind: 'custom',
				})} --> ${submenuLinks.join('')} <!-- /wp:navigation-submenu -->`
			: submenuLinks.join(''); // only 1 link here

	await updateNavigation(navigationId, topLevelLinks + additionalLinks);
};

const getNavAttributes = (headerCode) => {
	try {
		return JSON.parse(headerCode.match(/<!-- wp:navigation([\s\S]*?)-->/)[1]);
	} catch (e) {
		return {};
	}
};

export const updateNavAttributes = (headerCode, attributes) => {
	const newAttributes = JSON.stringify({
		...getNavAttributes(headerCode),
		...attributes,
	});
	return headerCode.replace(
		/(<!--\s*wp:navigation\b[^>]*>)([^]*?)(<!--\s*\/wp:navigation\s*-->)/gi,
		`<!-- wp:navigation ${newAttributes} /-->`,
	);
};

export const getActivePlugins = () => api.get('launch/active-plugins');

export const prefetchAssistData = async () =>
	await api.get('launch/prefetch-assist-data');

export const processPlaceholders = (patterns) =>
	apiFetch({
		path: '/extendify/v1/shared/process-placeholders',
		method: 'POST',
		data: { patterns },
	});

export const postLaunchFunctions = () =>
	apiFetch({
		path: '/extendify/v1/launch/post-launch-functions',
		method: 'POST',
	});
