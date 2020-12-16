/**
 * RelatedEntries JS Plugin
 * @author 		Bican Marian Valeriu
 * @license 	https://www.wecodeart.com/
 * @uses		Component Class
 * @uses		Template Class
 */

export default (function (wecodeart) {

	const { Component, Template } = wecodeart;

	const isEven = (value) => {
		if (value % 2 == 0) return true;
		else return false;
	};

	// Add Related Template
	Template.addTemplate('related-post', (entry) => {
		const {
			title,
			link,
			date_gmt: dateOpts,
			featured_media: {
				url: imageURL
			},
			author: {
				name,
				avatar
			},
			options = { year: 'numeric', month: 'long', day: 'numeric' },
			lang = document.documentElement.getAttribute('lang') || 'en-US'
		} = entry;

		const date = new Date(dateOpts);
		const attrMatcher = /(?:class *= *[\'\"]{0,1})((?:[\w -](?!\w+=|\/))+)[\'\"]*/gi;

		const postHTML = document.createElement('article');
		postHTML.className = 'related-posts__item related-post related-post--js col-12 col-md-6';
		postHTML.style.backgroundImage = `url('${imageURL}')`;
		postHTML.innerHTML = `
			<a href="${link}" class="related-post__body position-relative d-block p-3 p-md-4">
				<h4 class="related-post__title font-weight-bold mb-1 text-truncate">${title.rendered}</h4>
				<p class="related-post__date mb-2 text-primary">
					<i class="fal fa-clock me-2"></i>
					<time class="text-muted" datetime="${dateOpts}">${date.toLocaleDateString(lang, options)}</time>
				</p>
				<p class="related-post__author mb-0">
					${avatar.replace(attrMatcher, 'class="related-post__avatar rounded-circle d-inline-block mr-2"')}
					<span class="font-weight-bold text-dark">by ${name}</span>
				</p>
			</a> 
		`;

		return postHTML;
	});

	// Set Defaults
	const pluginDefaults = {
		path: '/wp/v2/posts',
		postId: 0,
		query: {
			amount: 4,
		},
		template: 'related-post',
		observer: {
			root: null,
			rootMargin: '0px',
			threshold: 0
		},
		afterFetching: (data, options) => {
			const { Template } = wecodeart;
			const { element, template, classes: { loaded, loading } } = options;
			const hideIfEven = e => e.classList.add('d-none');
			element.classList.remove(loading);
			data.map((e, i) => element.querySelector('.row').children[i].replaceWith(Template.render(template, e)));
			if (isEven(data.length)) {
				element.querySelectorAll('.related-post:not(.related-post--js)').forEach(hideIfEven);
			}
			element.classList.add(loaded);
		},
		classes: {
			loading: 'js--is-loading',
			loaded: 'js--loaded',
		},
	};

	/**
	 * @class
	 */
	class RelatedEntries extends Component {
		/**
		 * Construct Animate instance
		 * @constructor
		 * @param {Element} el
		 * @param {Object} options
		 */
		constructor(el, options) {
			super(RelatedEntries, el, options);
			this.el.RelatedEntries = this;
			/**
			 * Options for the animation
			 * @member RelatedEntries#options
			 */
			this.options = Object.assign({}, RelatedEntries.defaults, {
				element: this.el,
			}, options);
			RelatedEntries._elements.push(this);
			this._setupEventHandlers();
		}

		static get defaults() {
			return pluginDefaults;
		}

		static init(els, options) {
			return super.init(this, els, options);
		}

		/**
		 * Get Instance
		 */
		static getInstance(el) {
			const domElem = el.jquery ? el[0] : el;
			return domElem.RelatedEntries;
		}

		/**
		 * Teardown component
		 */
		destroy() {
			if (RelatedEntries.getInstance(this.el)) {
				this._removeEventHandlers();
				const index = RelatedEntries._elements.indexOf(this);
				RelatedEntries._elements.splice(index, 1);
				this.el.RelatedEntries = undefined;
			}
		}

		_removeClasses() {
			// IE 11 bug (can't remove multiple classes in one line)
			this.el.classList.remove(this.options.classes.loaded);
		}

		/**
		 * Setup Events
		 */
		_setupEventHandlers() {
			const { postId, afterFetching, classes: { loading }, query, observer } = this.options;
			const theObserver = new IntersectionObserver((el) => {
				if (el.shift().isIntersecting) {
					this.el.classList.add(loading);
					RelatedEntries.get({ postId, query }).then(d => afterFetching(d, this.options)).catch(e => console.warn(e));
					theObserver.unobserve(this.el);
				}
			}, observer);
			theObserver.observe(this.el);
		}

		/**
		 * Remove Event Handlers
		 */
		_removeEventHandlers() {
			if (RelatedEntries.getInstance(this.el)) {
				// DO stuff
			};
		}

		/**
		 * Retrieves events for a date range
		 *
		 * @param {object} options
		 */
		static async get({ postId, query: data }) {
			const { apiFetch, url: { addQueryArgs } } = wp;
			const { path } = RelatedEntries.defaults;
			return await apiFetch({ path: addQueryArgs(`${path}/${postId}/related`, data) });
		}
	}

	/**
	 * @static
	 * @memberof RelatedEntries
	 */
	RelatedEntries._elements = [];
	wecodeart.plugins.RelatedEntries = RelatedEntries;

}).apply(this, [window.wecodeart]);