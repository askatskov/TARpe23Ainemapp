import apiFetch from '@wordpress/api-fetch';
import { addQueryArgs } from '@wordpress/url';

export const installPlugin = async (slug) => {
	try {
		return await apiFetch({
			path: '/wp/v2/plugins',
			method: 'POST',
			data: {
				slug: slug,
				status: 'active',
			},
		});
	} catch {
		// Fail silently
	}

	await activatePlugin(slug);
};

export const activatePlugin = async (slug) => {
	const plugin = await getPlugin(slug);
	return await apiFetch({
		path: `/wp/v2/plugins/${plugin.plugin}`,
		method: 'POST',
		data: {
			status: 'active',
		},
	});
};

export const getPlugin = async (slug) => {
	const response = await apiFetch({
		path: addQueryArgs('/wp/v2/plugins', { search: slug }),
	});

	return response?.[0];
};
