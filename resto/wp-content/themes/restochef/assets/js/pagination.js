"use strict";
var restochef = restochef || {};
let loadType, currentPage, maxPage;
let loadButtonWrapper = document.querySelector(".restochef-load-posts-btn-wrapper");
let loadButton = document.querySelector(
    ".restochef-load-posts-btn-wrapper .load-btn"
);
let loader = document.querySelector(".restochef-ajax-loader");
let articleWrapper = document.querySelector(".restochef-article-wrapper");
if(loadButtonWrapper){
    loadType = loadButtonWrapper.getAttribute("data-load-type");
    currentPage = parseInt(loadButtonWrapper.getAttribute("data-page"));
    maxPage = parseInt(loadButtonWrapper.getAttribute("data-max-pages"));
}
let nextPage = currentPage + 1;
let canBeLoaded = true;
let rootElement = document.documentElement;

restochef.ajaxloadPosts = {
    init: function () {
        let _this = this;

        if (loadButtonWrapper) {
            // Load Posts on Click.
            if ("ajax_load_on_click" == loadType) {
                loadButtonWrapper.style.display = "block";
                loadButton.addEventListener("click", function (e) {
                    e.preventDefault();
                    _this.fetchThePosts();
                });
            }

            // Load Posts on Scroll.
            if ("ajax_load_on_scroll" == loadType) {
                loadButtonWrapper.style.display = "block";
                loadButton.style.display = "none";

                window.addEventListener("scroll", function (event) {
                    let btnOffsetTop =
                        loadButtonWrapper.getBoundingClientRect().top +
                        window.scrollY;

                    let offset = btnOffsetTop - rootElement.scrollTop;
                    if (nextPage <= maxPage) {
                        if (700 > offset && canBeLoaded) {
                            _this.fetchThePosts();
                        }
                    }
                });
            }
        }
    },

    fetchThePosts: function () {
        loadButton.style.display = "none";
        loader.classList.add("active");
        canBeLoaded = false;
        fetch(RestochefVars.ajaxurl, {
            method: "POST",
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
                "Cache-Control": "no-cache",
            },
            body: new URLSearchParams({
                action: "restochef_load_posts",
                nonce: RestochefVars.nonce,
                query_vars: RestochefVars.query_vars,
                page: nextPage,
            }),
        })
            .then((response) => {
                return response.json();
            })
            .then((res) => {
                if (res.success) {
                    loader.classList.remove("active");
                    let fetchedContent = res.data.content;

                    // Append the content.
                    articleWrapper.insertAdjacentHTML(
                        "beforeend",
                        fetchedContent
                    );

                    var tempDiv = document.createElement('div');
                    tempDiv.innerHTML = fetchedContent;
                    var elementsWithDataBg = tempDiv.querySelectorAll('.data-bg');
                    if (elementsWithDataBg.length > 0) {
                        restochef.setBackgroundImage.init();
                    }

                    currentPage = nextPage;
                    nextPage++;

                    if (nextPage <= maxPage) {
                        if ("ajax_load_on_click" == loadType) {
                            loadButton.style.display = "block";
                        }
                    } else {
                        loadButtonWrapper.style.display = "none";
                    }

                    canBeLoaded = true;
                } else {
                    loader.classList.remove("active");
                }
            })
            .catch((error) => {
                console.log(error);
            });
    },
};

restochefDomReady(function () {
    if(loadButtonWrapper){
        restochef.ajaxloadPosts.init();
    }
});
