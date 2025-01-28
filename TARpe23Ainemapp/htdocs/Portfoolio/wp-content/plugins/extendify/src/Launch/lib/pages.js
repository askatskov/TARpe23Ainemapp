import {
	ContentGathering,
	state as contentGatheringState,
} from '@launch/pages/ContentGathering';
import { Goals, state as goalsState } from '@launch/pages/Goals';
import { HomeSelect, state as homeSelectState } from '@launch/pages/HomeSelect';
import {
	SiteInformation,
	state as siteInfoState,
} from '@launch/pages/SiteInformation';
import { SitePrep, state as sitePrepState } from '@launch/pages/SitePrep';
import {
	SiteStructure,
	state as siteStructureState,
} from '@launch/pages/SiteStructure';

// This is the default pages array
// You can add pre-fetch functions to start fetching data for the next page
// Supports both [] and single fetcher functions
export const pages = [
	[
		'site-information',
		{
			component: SiteInformation,
			state: siteInfoState,
		},
	],
	[
		'site-prep',
		{
			component: SitePrep,
			state: sitePrepState,
		},
	],
	[
		'goals',
		{
			component: Goals,
			state: goalsState,
		},
	],
	[
		'site-structure',
		{
			component: SiteStructure,
			state: siteStructureState,
		},
	],
	[
		'content-fetching',
		{
			component: ContentGathering,
			state: contentGatheringState,
		},
	],
	[
		'layout',
		{
			component: HomeSelect,
			state: homeSelectState,
		},
	],
	// The page select data is in PageControl.jsx
];
