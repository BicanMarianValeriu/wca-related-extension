/**
 * @package: 	WeCodeArt Related Posts
 * @author: 	BicanMarianValeriu
 * @license:	https://www.wecodeart.com/
 * @version:	1.0.0
 */
import { default as icons } from './icons';

const { hooks: { doAction } } = wp;
const { FA } = wecodeart;

wecodeart = {
	...wecodeart,
	...{
		routes: {
			...wecodeart.routes,
			wcaExtRelatedEntries: {
				init: () => {
					import( /* webpackChunkName: "js/RelatedEntries" */ './RelatedEntries').then(() => {
						const { plugins: { RelatedEntries } } = wecodeart;

						FA.add(icons);

						doAction('wecodeart.extension.relatedEntries.loaded', RelatedEntries);

						const related = document.querySelectorAll('[data-plugin-related]');
						RelatedEntries.init(related);
					});
				}
			},
		}
	}
}; 