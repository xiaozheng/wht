var TLUserControls = function (data) {
    var self = this;
    self.domRoot = $("#tl-uc-controls").get()[0];
    self.domLaunch = $(self.domRoot).find(".launch").get()[0];
    self.domMenu = $(self.domRoot).find(".menu-holder").get()[0];
    self.domOptions = $(self.domMenu).find("li").get();
    self.domPanel = $("#tl-uc-panel").get()[0];
    self.animating = false;
    self.launched = false;
    self.menuWidth = 325;
    self.defaultPos = 10;
    self.openPos = 25;
    self.domCarousel = $(self.domRoot).find(".fp-carousel").get()[0];
    self.domStage = $(self.domRoot).find(".fp-stage").get()[0];
    self.domBlocks = $(self.domRoot).find(".fp-block").get();
    self.selectedBlock = 0;
    self.blockControllers = false;
    self.mainController = theTLMainController;
    self.timeline = theTLMainController.timeline;
    self.viewsByName = [];
    self.translated = false;
       
}
TLUserControls.prototype = {
    init: function () {
        var self = this;

        $(self.domLaunch).click(function () {
            if (self.launched) {
                self.close();
		
            } else {
                self.launch();
            }
            return false;
        });
        $(self.domOptions).click(function () {
            var pos = $(this).attr("fppos");
            var openBlock = self.selectedBlock;
            self.jumpTo({
                pos: pos,
                callback: function () {
                    self.blockClosed({
                        block: openBlock
                    });
                }
            });
            return false;
        });
        $(self.domRoot).find(".close-panel").click(function () {
            self.close();
            return false;
        });
        $(self.domRoot).mousemove(function (e) {
            e.stopPropagation();
        });
        self.showButton();
        self.doTranslation();
        return self;
    },
    langDidChange: function () {
        var self = this;
        self.doTranslation();
        if (self.viewsByName["search"]) {
            self.viewsByName["search"].defaultText = self.trans.enterSearchTerm;
        }
    },
    doTranslation: function () {
        var self = this;
        var trans = TLTranslation[self.timeline.language];
        if (trans && trans.userControls) {
            var t = trans.userControls;
            self.trans = t;
            var menuItems = $(self.domRoot).find(".menu-holder li");
            $(menuItems[0]).find("a").text(t["search"]);
            $(menuItems[1]).find("a").text(t["categories"]);
            $(menuItems[2]).find("a").text(t["viewType"]);
            $(menuItems[3]).find("a").text(t["spacing"]);
            $(menuItems[4]).find("a").text(t["zoom"]);
            $(menuItems[3]).css({
                display: ((self.timeline.language == "english" || self.timeline.language == "english-common") ? "inline-block" : "none")
            });
            $("#uc-text-search").text(t["search"]);
            $("#ft-fch-sp-input").attr("value", t["enterSearchTerm"]);
            $("#ft-fch-sp-button").text(t["go"]);
            $("#uc-text-displaying").text(t["displaying"]);
            $("#ft-fch-sp-everyone-message").text(t["allStories"]);
            $("#uc-text-matching").text(t["matching"]);
            $("#ft-fch-sp-clear").text(t["clear"]);
            $("#uc-text-category-filter").text(t["categories"]);
            $("#uc-text-view-type").text(t["viewType"]);
            $("#tl-uc-view-type-block .tl-isl-standard p").text(t["standard"]);
            $("#tl-uc-view-type-block .tl-isl-category p").text(t["categoryBands"]);
            $("#tl-uc-view-type-block .tl-isl-coloured p").text(t["colouredStories"]);
            $("#tl-uc-view-type-block .tl-isl-duration p").text(t["duration"]);
            $("#uc-text-spacing").text(t["storySpacing"]);
            $("#uc-text-zoom").text(t["zoom"]);
        }
    },
    updateView: function (data) {
        var self = this;
        if (self.viewsByName[data.view]) {
            self.viewsByName[data.view].updateView();
        }
    },
    isActiveBlock: function (data) {
        var self = this;
        return (self.blockControllers[self.selectedBlock] == data.block);
    },
    showButton: function () {
        var self = this;
        $(self.domRoot).css({
            display: "block"
        });
    },
    hideButton: function () {
        var self = this;
        $(self.domRoot).css({
            display: "none"
        });
        self.close();
    },
    launch: function () {
        var self = this;
        if (!self.blockControllers) {
            self.initialiseBlockControllers();
	  
        }
        if (!self.translated) {
            self.doTranslation();
            self.translated = true;
        }
        if (self.animating || self.launched) {
            return;
        }
        self.animating = true;
        self.blockControllers[self.selectedBlock].prepareForView();
        if ($.browser.msie) {
            $(self.domPanel).css({
                display: "block"
            });
            $(self.domRoot).css({
                right: self.openPos
            });
            $(self.domMenu).css({
                display: "block",
                width: 325
            });
            self.launched = true;
            self.animating = false;
        } else {
            $(self.domRoot).animate({
                right: self.openPos
            }, 500);
            $(self.domPanel).css({
                opacity: 0,
                display: "block"
            }).animate({
                opacity: 1
            }, 500, function () {});
            $(self.domMenu).css({
                display: "block"
            }).animate({
                width: 325
            }, 500, function () {
                self.launched = true;
                self.animating = false;
            });
        }
	
    },
    close: function () {
        var self = this;
        if (self.animating || self.launched == false) {
            return;
        }
        self.animating = true;
        if ($.browser.msie) {
            $(self.domRoot).css({
                right: self.defaultPos
            });
            $(self.domPanel).css({
                display: "none"
            });
            $(self.domMenu).css({
                display: "none"
            });
            self.launched = false;
            self.animating = false;
            self.blockClosed({
                block: self.selectedBlock
            });
        } else {
            $(self.domRoot).animate({
                right: self.defaultPos
            }, 500);
            $(self.domPanel).animate({
                opacity: 0
            }, 500, function () {
                $(this).css({
                    display: "none"
                });
            });
            $(self.domMenu).animate({
                width: 0
            }, 500, function () {
                $(this).css({
                    display: "none"
                });
                self.launched = false;
                self.animating = false;
                self.blockClosed({
                    block: self.selectedBlock
                });
            });
        }
    },
    blockClosed: function (data) {
        var self = this;
        var block = self.blockControllers[data.block];
        if (block.viewHasEnded) {
            block.viewHasEnded();
        }
    },
    initialiseBlockControllers: function () {
        var self = this;
        self.blockControllers = [];
        self.viewsByName["search"] = self.blockControllers[0] = new TLUCSearch({
            controller: self
        }).init();
        self.viewsByName["category"] = self.blockControllers[1] = new TLUCCategoryFilter({
            controller: self
        }).init();
        self.viewsByName["view"] = self.blockControllers[2] = new TLUCViewType({
            controller: self
        }).init();
        self.viewsByName["spacing"] = self.blockControllers[3] = new TLUCSpacing({
            controller: self
        }).init();
        self.viewsByName["zoom"] = self.blockControllers[4] = new TLUCZoom({
            controller: self
        }).init();
    },
    refreshTimelineView: function () {
        var self = this;
        self.mainController.selected3DView.clearStories3DText();
        if (self.timeline.viewType == "category-band") {
            self.mainController.sortMarkersByCategoryList();
        }
        self.mainController.updateViewsWithNewDateRangeAndZoom({
            zoom: self.timeline.zoom
        });
        self.mainController.flushSize();
    },
    jumpTo: function (data) {
        var self = this;
        var newPos = data.pos;
        var callback = data.callback;
        var duration = (data.instantly) ? 0 : 300;
        if (self.selectedBlock == newPos) {
            return;
        }

        self.blockControllers[newPos].prepareForView();

        var oldPos = self.selectedBlock;
        self.selectedBlock = newPos;
        $(self.domOptions[oldPos]).removeClass("selected");
        $(self.domOptions[newPos]).addClass("selected");
        self.carouselHeight = $(self.domCarousel).height();
        if (newPos > oldPos) {
            $(self.domBlocks[newPos]).css({
                display: "block"
            });
            $(self.domStage).animate({
                marginTop: -self.carouselHeight
            }, duration, function () {
                $(self.domBlocks[oldPos]).css({
                    display: "none"
                });
                $(this).css({
                    marginTop: "0"
                });
                if (callback) {
                    callback();
                }
            });
        } else {
            $(self.domBlocks[newPos]).css({
                display: "block"
            });
            $(self.domStage).css({
                marginTop: -self.carouselHeight
            });
            $(self.domStage).animate({
                marginTop: 0
            }, duration, function () {
                $(self.domBlocks[oldPos]).css({
                    display: "none"
                });
                if (callback) {
                    callback();
                }
            });
        }
    }
}
var TLUCCategoryFilter = function (data) {
    var self = this;
    self.controller = data.controller;
    self.initialised = false;
}
TLUCCategoryFilter.prototype = {
    init: function () {
        var self = this;
        return self;
    },
    updateView: function () {
        var self = this;
        if (!self.initialised) {
            return
        };
        self.showAllCategories();
        self.flushTimelineCategories();
        $(self.domList).removeClass("tl-ccl-denser").empty();
        self.initialised = false;
        if (self.controller.isActiveBlock({
            block: self
        })) {
            self.prepareForView();
        }
    },
    initialise: function () {
        var self = this;
        self.activeCounter = 0;
        self.domRoot = $("#tl-uc-view-filter-block").get()[0];
        self.domList = $(self.domRoot).find(".tl-colour-checkbox-list").get()[0];
        self.mainController = theTLMainController;
        self.timeline = self.mainController.timeline;
        self.categories = self.timeline.categories;
        if (self.categories.length > 0 && !(self.categories.length == 1 && self.categories[0].autoGenerated == true)) {
            self.generateCheckboxes();
        } else {
            $(self.domList).remove();
            self.showEmptyMessage();
        }
        if (self.categories.length > 7) {
            $(self.domList).addClass("tl-ccl-denser");
        }
        $(self.domList).unbind("click").click(function (e) {
            var domItem = AJKHelpers.getSelfOrFirstParantOfClass({
                domEl: e.target,
                className: "tl-ccl-item"
            });
            if (domItem) {
                var arriveCounter = self.activeCounter;
                var iKey = $(domItem).attr("key");
                if (iKey == "show-all") {
                    self.showAllCategories();
                    self.flushTimelineCategories();
                } else {
                    var category = self.timeline.categoriesByKey[iKey];
                    if (category.active) {
                        category.active = false;
                        category.hide = true;
                        self.activeCounter--;
                    } else {
                        category.active = true;
                        category.hide = false;
                        self.activeCounter++;
                    }
                    self.updateCheckboxes();
                    if (arriveCounter == 0) {
                        $.each(self.categories, function () {
                            if (this != category) {
                                this.active = false;
                                this.hide = true;
                            }
                        });
                    }
                    if (self.activeCounter == self.categories.length) {
                        $(self.domShowAll).addClass("selected").removeClass("inactive");
                    } else if (self.activeCounter == 0) {
                        self.showAllCategories();
                    } else {
                        $(self.domShowAll).removeClass("selected").addClass("inactive");
                    }
                    self.flushTimelineCategories();
                }
            }
        });
        self.initialised = true;
    },
    showAllCategories: function () {
        var self = this;
        $(self.domList).find("li").removeClass("inactive").removeClass("selected");
        $(self.domShowAll).addClass("selected");
        $.each(self.categories, function () {
            this.active = false;
            this.hide = false;
        });
        self.activeCounter = 0;
    },
    flushTimelineCategories: function () {
        var self = this;
        self.mainController.filterMarkersByActiveCategories();
        self.mainController.selected3DView.redisplay();
    },
    prepareForView: function () {
        var self = this;
        if (!self.initialised) {
            self.initialise();
        }
    },
    generateCheckboxes: function () {
        var self = this;
        var iHTML = "";
        var showAllText = (self.controller.trans) ? self.controller.trans.showAll : "Show All";
        iHTML += '<li key="show-all" class="tl-ccl-item selected"><span style="background-color: #fff"></span><p>' + showAllText + '</p></li>';
        $.each(self.categories, function () {
            iHTML += '<li key="' + this.key + '" class="tl-ccl-item"><span style="background-color: #' + this.colour + '"></span><p>' + AJKHelpers.clipToMaxCharWords({
                aString: this.title,
                maxChars: 16
            }) + '</p></li>';
        });
        $(self.domList).empty().append(iHTML);
        self.domShowAll = $(self.domList).find("li:eq(0)").get()[0];
        self.domItemsByKey = [];
        $(self.domList).find("li").each(function () {
            self.domItemsByKey[$(this).attr("key")] = this;
        });
    },
    updateCheckboxes: function () {
        var self = this;
        $.each(self.categories, function () {
            var domItem = self.domItemsByKey[this.key];
            if (this.active) {
                $(domItem).addClass("selected").removeClass("inactive");
            } else {
                $(domItem).removeClass("selected").addClass("inactive");
            }
        });
    },
    showEmptyMessage: function () {
        var self = this;
        $(self.domRoot).append('<p class="message">Category filtering has been disabled for this timeline because it does not include any categories for filtering.</p>');
    },
    viewHasEnded: function () {
        var self = this;
    }
}
var TLUCViewType = function (data) {
    var self = this;
    self.controller = data.controller;
    self.initialised = false;
}
TLUCViewType.prototype = {
    init: function () {
        var self = this;
        return self;
    },
    initialise: function () {
        var self = this;
        self.domItems = $("#tl-uc-view-type-block li").get();
        self.mainController = theTLMainController;
        self.timeline = theTLMainController.timeline;
        self.viewTypes = theTLMainController.viewTypes;
        self.selectedView = self.timeline.viewTypeValue;
        $(self.domItems).click(function () {
            self.updateViewTo({
                view: $(this).attr("view")
            });
            return false;
        });
        self.initialised = true;
    },
    updateView: function () {
        var self = this;
        if (self.initialised) {
            self.selectItem({
                item: self.timeline.viewTypeValue
            });
        }
    },
    prepareForView: function () {
        var self = this;
        if (!self.initialised) {
            self.initialise();
        }
        self.selectItem({
            item: self.timeline.viewTypeValue
        });
    },
    updateViewTo: function (data) {
        var self = this;
        var view = data.view;
        if (view != self.selectedView) {
            self.selectItem({
                item: view
            });
            self.selectedView = view;
            self.timeline.viewTypeValue = view;
            self.timeline.viewType = self.viewTypes[view];
            self.controller.refreshTimelineView();
        }
        if (self.controller.blockControllers[1].activeCounter > 0) {
            $.each(self.mainController.markers, function () {
                if (!this.category || self.timeline.categoriesByKey[self.mainController.categoriesKeyPrefix + this.category.id].hide) {
                    $(this.domSliderPoint).css({
                        visibility: "hidden"
                    });
                }
            });
        }
    },
    selectItem: function (data) {
        var self = this;
        var item = data.item;
        $(self.domItems).removeClass("selected");
        $(self.domItems[item]).addClass("selected");
    }
}
var TLUCZoom = function (data) {
    var self = this;
    self.controller = data.controller;
    self.initialised = false;
}
TLUCZoom.prototype = {
    init: function () {
        var self = this;
        return self;
    },
    initialise: function () {
        var self = this;
        self.mainController = theTLMainController;
        self.timeline = theTLMainController.timeline;
        self.domRoot = $("#tl-uc-zoom-block").get()[0];
        self.zoomSelect = $(self.domRoot).find("select").get()[0];
        var iHTML = "";
        $.each(self.mainController.selectedView.availableScales, function () {
            iHTML += '<option value="' + this.name + '">' + this.name + '</option>';
        });
        $(self.zoomSelect).empty().append(iHTML);
        var itemCounter = 0;
        self.zoomSelectReplacer = new AJKSelectReplacer({
            domSelect: self.zoomSelect,
            createItemFunc: function (data) {
                var val = data.val;
                var text = data.text;
                var domZoomItem = $('<a pos="' + itemCounter + '" class="tl-ah-zoom-item" href="#">' + text + '</a>').get()[0];
                itemCounter++;
                return domZoomItem;
            },
            itemSelectedClass: "tl-ah-zoom-item-selected"
        }).init();
        $(self.zoomSelect).unbind("change").change(function () {
            self.updateZoomTo({
                zoom: $(this).val()
            });
        });
        $(self.domRoot).find(".zoom-buttons a").unbind("click").click(function () {
            if ($(this).text() == "+") {
                self.zoom({
                    zoomIn: true
                });
            } else {
                self.zoom({
                    zoomOut: true
                });
            }
            return false;
        });
        self.initialised = true;
    },
    updateView: function () {
        var self = this;
        if (self.initialised) {
            self.zoomSelectReplacer.selectItemFromVal({
                val: self.timeline.zoom
            });
        }
    },
    zoom: function (data) {
        var self = this;
        var cPos = $(self.domRoot).find(".tl-ah-zoom-item-selected").attr("pos");
        if (data.zoomIn) {
            cPos++;
        } else {
            cPos--;
        }
        if (self.mainController.selectedView.availableScales[cPos]) {
            self.updateZoomTo({
                zoom: self.mainController.selectedView.availableScales[cPos].name
            });
            self.zoomSelectReplacer.selectItemFromVal({
                val: self.timeline.zoom
            });
        }
    },
    updateZoomTo: function (data) {
        var self = this;
        self.mainController.updateViewsWithNewDateRangeAndZoom({
            zoom: data.zoom
        });
    },
    prepareForView: function () {
        var self = this;
        if (!self.initialised) {
            self.initialise();
        }
        self.zoomSelectReplacer.selectItemFromVal({
            val: self.timeline.zoom
        });
    }
}
var TLUCSpacing = function (data) {

    var self = this;
    self.controller = data.controller;
    self.initialised = false;
}
TLUCSpacing.prototype = {
    init: function () {
        var self = this;
        return self;
    },
    initialise: function () {
        var self = this;
        self.domRoot = $("#tl-uc-spacing-block").get()[0];
        self.domSelect = $(self.domRoot).find("select").get()[0];
        self.mainController = theTLMainController;
        self.timeline = theTLMainController.timeline;
        $(self.domSelect).change(function () {
            self.updateSpacing({
                spacing: $(this).val()
            });
        });
        self.initialised = true;
    },
    updateView: function () {
        var self = this;
        if (self.initialised) {
            $(self.domSelect).val(self.timeline.storySpacingType);
        }
    },
    prepareForView: function () {
        var self = this;
        if (!self.initialised) {
            self.initialise();
        }
        $(self.domSelect).val(self.timeline.storySpacingType);
    },
    updateSpacing: function (data) {
        var self = this;
	//alert(data.spacing);
        self.timeline.storySpacingType = data.spacing;
        self.timeline.markerSpacing = TLViewController.markerSpacingView[self.timeline.storySpacingType].type;
        self.timeline.equalMarkerSpacing = TLViewController.markerSpacingView[self.timeline.storySpacingType].markerSpacing;
        self.timeline.markerSpacingObj = TLViewController.markerSpacingView[self.timeline.storySpacingType];
        self.mainController.updateViewsWithNewDateRangeAndZoom({
            zoom: self.timeline.zoom
        });
        self.mainController.flushSize();
    }
}
var TLUCSearch = function (data) {
    var self = this;
    self.controller = data.controller;
    self.initialised = false;
    self.filterText = "";
    self.defaultText = self.controller.trans ? self.controller.trans.enterSearchTerm : "Enter search term";
}
TLUCSearch.prototype = {
    init: function () {
        var self = this;
        self.matchedStories = 0;
        return self;
    },
    initialise: function () {
        var self = this;
        self.mainController = theTLMainController;
        self.timeline = theTLMainController.timeline;
        self.domRoot = $("#tl-uc-search-block").get()[0];
        self.domInput = $("#ft-fch-sp-input").get()[0];
        self.domButton = $("#ft-fch-sp-button").get()[0];
        self.domClearLink = $("#ft-fch-sp-clear").get()[0];
        self.domFilterText = $("#ft-fch-sp-filter").get()[0];
        self.domNumStories = $("#ft-fch-sp-num-stories").get()[0];
        self.domFilterMessage = $("#ft-fch-sp-filter-message").get()[0];
        self.domEveryoneMessage = $("#ft-fch-sp-everyone-message").get()[0];
        $(self.domInput).val(self.defaultText).focus(function () {
            var thisText = $(this).val();
            if (thisText == self.defaultText) {
                $(this).val("");
            }
        }).blur(function () {
            var thisText = $(this).val();
            if (thisText == "") {
                $(this).val(self.defaultText);
            }
        }).keyup(function (e) {
            if (e.keyCode == 13) {
                $(self.domButton).click();
            }
        });
        $(self.domClearLink).click(function () {
            $(self.domInput).val(self.defaultText);
            self.filterText = "";
            self.filterStories();
            return false;
        });
        $(self.domButton).click(function () {
            self.filterText = $(self.domInput).val();
            self.filterText = (self.filterText == self.defaultText) ? "" : self.filterText;
            self.filterStories();
            return false;
        });
        self.initialised = true;
    },
    prepareForView: function () {
        var self = this;
        if (!self.initialised) {
            self.initialise();
        }
        self.updateSearchFilterText();
    },
    updateSearchFilterText: function () {
        var self = this;
        if (self.filterText) {
            $(self.domFilterText).text(self.filterText);
            $(self.domEveryoneMessage).css({
                display: "none"
            });
            var storiesText = (self.controller.trans) ? self.controller.trans.stories : "stories";
            var storyText = (self.trans) ? self.controller.trans.story : "story";
            var numStoryText = "<strong>" + self.matchedStories + "</strong>" + ((self.matchedStories != 1) ? " " + storiesText : " " + storyText);
            $(self.domNumStories).html(numStoryText);
            $(self.domFilterMessage).css({
                display: "inline"
            });
        } else {
            $(self.domFilterMessage).css({
                display: "none"
            });
            $(self.domEveryoneMessage).css({
                display: "inline"
            });
        }
    },
    filterStories: function () {
        var self = this;
        if (!self.filterText) {
            self.showAllStories();
            return;
        }
        var firstStory = "";
        self.matchedStories = 0;
        $.each(self.mainController.markers, function () {
            var searchText = this.headline + this.introText + this.fullText;
            if (searchText.toLowerCase().indexOf(self.filterText.toLowerCase()) == -1) {
                this.searchHide();
            } else {
                this.searchShow();
                firstStory = (!firstStory) ? this : firstStory;
                self.matchedStories++;
            }
        });
        if (firstStory) {
            self.mainController.focusMarker({
                marker: firstStory
            });
        }
        self.updateSearchFilterText();
        self.mainController.selected3DView.redisplay();
    },
    showAllStories: function () {
        var self = this;
        $.each(self.mainController.markers, function () {
            this.searchShow()
        });
        self.updateSearchFilterText();
        self.mainController.selected3DView.redisplay();
    },
    viewHasEnded: function () {
        var self = this;
        $(self.domClearLink).click();
    }
}
