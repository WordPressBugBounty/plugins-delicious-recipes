(function(delrecipesRecipeCard) {
    'use strict';

    function dr_block_print_recipe(recipeID, servings, blockType, blockId) {
        servings = servings || 0;
        blockType = blockType || 'recipe-card';
        blockId = blockId || 'delicious-recipes-pro-recipe-card';
    
        const urlParts = delrecipesRecipeCard.homeURL.split(/\?(.+)/);
        let printUrl = urlParts[0];
    
        if (delrecipesRecipeCard.permalinks) {
            printUrl += 'delrecipes_block_print/' + recipeID + '/';
    
            if (urlParts[1]) {
                printUrl += '?' + urlParts[1];
                printUrl += '&block-type=' + blockType;
                printUrl += '&block-id=' + blockId;
    
                if (servings) {
                    printUrl += '&servings=' + servings;
                }
            } else {
                printUrl += '?block-type=' + blockType;
                printUrl += '&block-id=' + blockId;
    
                if (servings) {
                    printUrl += '&servings=' + servings;
                }
            }
        } else {
            printUrl += '?delrecipes_block_print=' + recipeID;
            printUrl += '&block-type=' + blockType;
            printUrl += '&block-id=' + blockId;
    
            if (servings) {
                printUrl += '&servings=' + servings;
            }
    
            if (urlParts[1]) {
                printUrl += '&' + urlParts[1];
            }
        }

        const print_window = window.open(printUrl, '_blank');
        print_window.delrecipesRecipeCard = delrecipesRecipeCard;
        print_window.onload = function() {
            print_window.focus();
            print_window.document.title = document.title;
            print_window.history.pushState('', 'Print Recipe', location.href.replace(location.hash, ''));
            print_window.location.href = printUrl;
        };
    }

    document.addEventListener('DOMContentLoaded', function() {
        const servings_size = document.querySelector('.dr-buttons.dr-recipe-card-block-print .dr-print-trigger')?.dataset.servingsSize;

        if (servings_size) {
            const printTriggers = document.querySelectorAll('.dr-buttons.dr-recipe-buttons-block .dr-print-trigger');
            printTriggers.forEach(trigger => {
                trigger.dataset.servingsSize = servings_size;
            });
        }

        const printButtons = document.querySelectorAll('.dr-recipe-card-block-print .dr-print-trigger, .dr-recipe-buttons-block .dr-print-trigger');
        
        printButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const recipeID = this.dataset.recipeId;
                const servings = this.dataset.servingsSize;
    
                const isRecipeCardBlock = this.closest('.wp-block-delicious-recipes-block-recipe-card') !== null;
                const hasRecipeCardBlock = document.querySelector('.wp-block-delicious-recipes-block-recipe-card') !== null;
    
                let blockType;
                let blockId;
    
                if (isRecipeCardBlock) {
                    blockType = 'recipe-card';
                    blockId = this.closest('.wp-block-delicious-recipes-block-recipe-card').id;
                } else {                        
                    blockType = 'recipe-card';
                    blockId = this.getAttribute('href').substring(1);
                }
    
                if (recipeID && hasRecipeCardBlock) {
                    e.preventDefault();
                    dr_block_print_recipe(recipeID, servings, blockType, blockId);
                }
            });
        });
    });
}(delrecipesRecipeCard));