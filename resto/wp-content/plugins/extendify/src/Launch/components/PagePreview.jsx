import { BlockPreview } from '@wordpress/block-editor';
import { rawHandler } from '@wordpress/blocks';
import { Spinner } from '@wordpress/components';
import {
	useRef,
	useMemo,
	useState,
	useLayoutEffect,
	useCallback,
} from '@wordpress/element';
import { forwardRef } from '@wordpress/element';
import { pageNames } from '@shared/lib/pages';
import classNames from 'classnames';
import { AnimatePresence, motion } from 'framer-motion';
import themeJSON from '@launch/_data/theme-processed.json';
import { usePreviewIframe } from '@launch/hooks/usePreviewIframe';
import { hexTomatrixValues, lowerImageQuality } from '@launch/lib/util';

export const PagePreview = forwardRef(({ style, siteTitle, loading }, ref) => {
	const previewContainer = useRef(null);
	const blockRef = useRef(null);
	const [ready, setReady] = useState(false);

	const onLoad = useCallback(
		(frame) => {
			frame.contentDocument?.getElementById('ext-tj')?.remove();
			// Run this 150 times at an interval of 100ms (15s)
			// This is a brute force check that the styles are there
			let lastRun = performance.now();
			let counter = 0;
			const checkOnStyles = () => {
				if (counter >= 150) return;
				const now = performance.now();
				if (now - lastRun < 100) return requestAnimationFrame(checkOnStyles);
				lastRun = now;
				const content = frame?.contentDocument;
				if (content) {
					content.querySelector('[href*=load-styles]')?.remove();
					const siteTitleElement = content.querySelector('[href*=site-title]');
					if (siteTitleElement) siteTitleElement.textContent = siteTitle;
				}
				if (!frame.contentDocument?.getElementById('ext-tj')) {
					const primaryColor =
						style?.variation?.settings?.color?.palette?.theme?.find(
							({ slug }) => slug === 'primary',
						)?.color;
					const [r, g, b] = hexTomatrixValues(primaryColor);
					frame.contentDocument?.body?.insertAdjacentHTML(
						'beforeend',
						`<style id="ext-tj">
							.wp-block-missing { display: none !important }
							[class*=wp-duotone-] img[src^="data"] {
								filter: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg"><filter id="solid-color"><feColorMatrix color-interpolation-filters="sRGB" type="matrix" values="0 0 0 0 ${r} 0 0 0 0 ${g} 0 0 0 0 ${b} 0 0 0 1 0"/></filter></svg>#solid-color') !important;
							}
							${themeJSON[style?.variation?.title]}
						</style>`,
					);
				}

				// Look for any frames inside the iframe, like the html block
				const innerFrames = frame.contentDocument?.querySelectorAll('iframe');
				innerFrames?.forEach((inner) => {
					inner?.contentDocument
						?.querySelector('[href*=load-styles]')
						?.remove();
					inner?.contentDocument
						?.querySelector('body')
						?.classList.add('editor-styles-wrapper');
					if (inner && !inner.contentDocument?.getElementById('ext-tj')) {
						inner.contentDocument?.body?.insertAdjacentHTML(
							'beforeend',
							`<style id="ext-tj">
								body { background-color: transparent !important; }
								body, body * { box-sizing: border-box !important; }
								${themeJSON[style?.variation?.title]}
							</style>`,
						);
					}
				});

				counter++;
				requestAnimationFrame(checkOnStyles); // recursive
			};
			checkOnStyles();
		},
		[style?.variation, siteTitle],
	);

	const { ready: showPreview } = usePreviewIframe({
		container: ref.current,
		ready,
		onLoad,
		loadDelay: 400,
	});

	const blocks = useMemo(() => {
		const links = [
			pageNames.about.title,
			pageNames.blog.title,
			pageNames.contact.title,
		];

		const code = [
			style?.headerCode,
			style?.patterns
				?.map(({ code }) => code)
				.flat()
				.join(''),
			style?.footerCode,
		]
			.filter(Boolean)
			.join('')
			.replace(
				// <!-- wp:navigation --> <!-- /wp:navigation -->
				/<!-- wp:navigation[.\S\s]*?\/wp:navigation -->/g,
				`<!-- wp:paragraph {"className":"tmp-nav"} --><p class="tmp-nav">${links.join(' | ')}</p ><!-- /wp:paragraph -->`,
			)
			.replace(
				// <!-- wp:navigation /-->
				/<!-- wp:navigation.*\/-->/g,
				`<!-- wp:paragraph {"className":"tmp-nav"} --><p class="tmp-nav">${links.join(' | ')}</p ><!-- /wp:paragraph -->`,
			)
			.replace(
				/<!-- wp:site-logo.*\/-->/g,
				'<!-- wp:paragraph {"className":"custom-logo"} --><img alt="" class="custom-logo" style="height: 40px;" src="https://assets.extendify.com/demo-content/logos/extendify-demo-logo.png"><!-- /wp:paragraph -->',
			);
		return rawHandler({ HTML: lowerImageQuality(code) });
	}, [style]);

	useLayoutEffect(() => {
		setReady(false);
		const timer = setTimeout(() => setReady(true), 0);
		return () => clearTimeout(timer);
	}, [blocks]);

	const isLoading = !showPreview && loading;

	return (
		<>
			<AnimatePresence>
				{(isLoading || !showPreview) && (
					<motion.div
						initial={{ opacity: 0.7 }}
						animate={{ opacity: 1 }}
						exit={{ opacity: 0 }}
						transition={{ duration: 0.3 }}
						className="pointer-events-none absolute inset-0 z-30"
						style={{
							// opacity: showPreview || !ready ? 0 : 1,
							backgroundColor: 'rgba(204, 204, 204, 0.25)',
							backgroundImage:
								'linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.5) 50%, rgba(255,255,255,0) 100%)',
							backgroundSize: '600% 600%',
							animation: 'extendify-loading-skeleton 10s ease-in-out infinite',
						}}>
						<div className="absolute inset-0 flex items-center justify-center">
							<Spinner className="h-10 w-10 text-design-main" />
						</div>
					</motion.div>
				)}
			</AnimatePresence>
			<div
				data-test="layout-preview"
				ref={blockRef}
				className={classNames('group z-10 w-full bg-transparent', {
					'opacity-0': !showPreview,
				})}>
				<div
					ref={previewContainer}
					className="relative m-auto max-w-[1440px] rounded-lg">
					<BlockPreview
						blocks={blocks}
						viewportWidth={1440}
						additionalStyles={[
							{
								css: '.rich-text [data-rich-text-placeholder]:after { content: "" }',
							},
						]}
					/>
				</div>
			</div>
		</>
	);
});
