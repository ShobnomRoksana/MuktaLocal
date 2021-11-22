// (function($) {
//   const rootElement = document.documentElement
//
//   document.addEventListener('DOMContentLoaded', ready => {
//   	gallery(rootElement, document.querySelector('.pswp'))
//   })
//
//   /**
//    * @param {ParentNode} where
//    * @param {HTMLElement} holder - Root of UI. You have to add it with template, not with JS
//    */
//   const gallery = (where, holder) => {
//   	const galleryElements = where.querySelectorAll('[data-gallery]')
//   	for (const element of galleryElements) {
//   		const galleryID = element.dataset.gallery
//   		const items = where.querySelectorAll(`[data-gallery='${galleryID}']`)
//   		element.addEventListener('click', event => {
//   			event.preventDefault()
//   			openPhotoSwipe({
//   				holder,
//   				items: galleryItemsElementsToArray(items),
//   				galleryID,
//   				index: Array.from(items).indexOf(event.currentTarget),
//   			})
//   		})
//   	}
//   }
//
//   /**
//    * @typedef PhotoswipeItem
//    * @prop {string} src
//    * @prop {string} msrc
//    * @prop {int} w
//    * @prop {int} h
//    * @prop {string} title
//    */
//
//   /**
//    * @param {HTMLElement} holder
//    * @param {PhotoswipeItem[]} items
//    * @param {string} galleryID
//    * @param {int} index
//    */
//   const openPhotoSwipe = ({ holder, items, galleryID, index = 0 }) => {
//   	const options = {
//   		history: true,
//   		shareEl: false,
//   		galleryUID: galleryID,
//   		index,
//       getDoubleTapZoom: function(isMouseClick, item) {
//           if(isMouseClick) {
//               return 1.6;
//           } else {
//               return item.initialZoomLevel < 0.7 ? 1.6 : 1.33; //<---- 4 here
//           }
//       },
//       maxSpreadZoom: 1.6,
//   	}
//   	const gallery = new PhotoSwipe(holder, PhotoSwipeUI_Default, items, options)
//   	photoswipePreviews(gallery)
//   	gallery.init()
//   }
//
//   /**
//    * @param {NodeList} anchors
//    * @returns {PhotoswipeItem[]}
//    */
//   const galleryItemsElementsToArray = (anchors) => {
//   	let array = []
//
//   	for (const anchor of anchors) {
//   		const img = anchor.querySelector('img')
//
//   		const full = anchor.href
//   		const preview = img.src
//   		const title = img.alt
//       // const width= img.width
//       // const height= img.height
//
//   		const [width, height] = anchor.dataset.size.split('x')
//
//   		array.push({
//   			src: full,
//   			msrc: preview,
//   			w: width,
//   			h: height,
//   			title,
//   		})
//   	}
//
//   	return array
//   }
//
//   /// previews
//
//   /**
//    * @param {object} gallery
//    */
//   const photoswipePreviews = gallery => {
//   	let added = false
//   	const props = {
//   		gallery,
//   		selector: '[data-previews]',
//   	}
//   	gallery.listen('gettingData', () => {
//   		if (added) return
//   		added = true
//   		addPreviews(props)
//   	})
//   	gallery.listen('close', () => {
//   		removePreviews(props)
//   	})
//   	gallery.listen('afterChange', () => {
//   		setActivePreview(props)
//   	})
//   }
//
//   /**
//    * @typedef photoSwipePreviewsMethodProps
//    * @prop {object} gallery
//    * @prop {string} selector
//    */
//
//   /**
//    * @param {photoSwipePreviewsMethodProps} props
//    */
//   const addPreviews = ({ gallery, selector }) => {
//   	const { scrollWrap, items } = gallery
//   	const place = scrollWrap.querySelector(selector)
//   	for (const item of items) {
//   		const { msrc: preview } = item
//   		const element = document.createElement('img')
//   		element.setAttribute('src', preview)
//   		element.addEventListener('click', () => {
//   			gallery.goTo(items.indexOf(item))
//   		})
//   		place.appendChild(element)
//   	}
//   }
//
//   /**
//    * @param {photoSwipePreviewsMethodProps} props
//    */
//   const removePreviews = ({ gallery, selector }) => {
//   	const { scrollWrap } = gallery
//   	const place = scrollWrap.querySelector(selector)
//   	place.innerHTML = ''
//   }
//
//   /**
//    * @param {photoSwipePreviewsMethodProps} props
//    */
//   const setActivePreview = ({ gallery, selector }) => {
//   	const { scrollWrap, currItem } = gallery
//   	const { msrc: preview } = currItem
//   	const place = scrollWrap.querySelector(selector)
//   	const previewElements = place.querySelectorAll('img')
//   	for (const element of previewElements) {
//   		const src = element.getAttribute('src')
//   		const className = 'is-active'
//   		// Warning: collision possible if image not unique
//   		if (src === preview) {
//   			element.classList.add(className)
//   			element.scrollIntoView({ behavior: 'smooth' })
//   		}
//   		else element.classList.remove(className)
//   	}
//   }
// })(jQuery);

jQuery(document).ready(function($){
  $("#custom_product_gallery").lightGallery();
});

jQuery(document).ready(function($){
	$('.custom_gallery_slider').slick({
		infinite: false,
		slidesToShow: 1
  });
});

jQuery(document).ready(function($){
  $('.custom_thumbnail_slider')
  .on('init', function(event, slick) {
    $('.custom_thumbnail_slider .slick-slide.slick-current').addClass('is-active');
  })
  .slick({
   slidesToShow: 5,
   slidesToScroll: 1,
   dots: false,
   focusOnSelect: true,
   infinite: false,
   responsive: [{
     breakpoint: 1024,
     settings: {
       slidesToShow: 5,
       slidesToScroll: 1,
     }
   }, {
     breakpoint: 640,
     settings: {
       slidesToShow: 4,
       slidesToScroll: 1,
     }
   }, {
     breakpoint: 420,
     settings: {
       slidesToShow: 3,
       slidesToScroll: 1,
   }
   }]
  });

  $('.custom_gallery_slider').on('afterChange', function(event, slick, currentSlide) {
    $('.custom_thumbnail_slider').slick('slickGoTo', currentSlide);
    var currrentNavSlideElem = '.custom_thumbnail_slider .slick-slide[data-slick-index="' + currentSlide + '"]';
    $('.custom_thumbnail_slider .slick-slide.is-active').removeClass('is-active');
    $(currrentNavSlideElem).addClass('is-active');
  });

  $('.custom_thumbnail_slider').on('click', '.slick-slide', function(event) {
    event.preventDefault();
    var goToSingleSlide = $(this).data('slick-index');
    $('.custom_gallery_slider').slick('slickGoTo', goToSingleSlide);
  });
});

// Cross Sell Products Slider
jQuery(document).ready(function($){
  $('.cross-sells-products').slick({
      infinite: true,
      autoplay: true,
      speed: 300,
      autoplaySpeed: 4000,
      slidesToShow: 4,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            cssEase: 'linear'
          }
        }
      ]
  });
});

// Upsell Products slider
jQuery(document).ready(function($){
  $('.upsells_products').slick({
      infinite: true,
      autoplay: true,
      speed: 300,
      autoplaySpeed: 4000,
      slidesToShow: 4,
      slidesToScroll: 1,
      lazyLoad:'ondemand',
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            cssEase: 'linear'
          }
        }
      ]
  });
});

// Recently Viewed Products slider
jQuery(document).ready(function($){
  $('.recently_viewed_products').slick({
      infinite: true,
      autoplay: true,
      speed: 300,
      autoplaySpeed: 4000,
      slidesToShow: 4,
      slidesToScroll: 1,
      lazyLoad:'ondemand',
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            cssEase: 'linear'
          }
        }
      ]
  });
});
