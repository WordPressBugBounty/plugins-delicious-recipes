import { __ } from '@wordpress/i18n';
import { createContext, useContext, useState } from '@wordpress/element';

export const RecipeContext = createContext();

export default function RecipeContextProvider({ children }) {
    const [globalState, setGlobalState] = useState({
        loading: false,
        selectedOption: '',
        showMsg: true,
        importStart: false,
        importSuccess: false,
        pns: false,
        recipes: [],
        recipeCount: 0,
        recipesToList: [],
        list: 10,
        currentPage: 1,
        recipesToImport: [],
        deleteRecipes: false,
        recipeFields: [],
        importPluginFields: [],
    });

    const wpd_fields = {
        'recipe-course': __('Recipe Courses', 'delicious-recipes'),
        'recipe-cuisine': __('Recipe Cuisines', 'delicious-recipes'),
        'recipe-cooking-method': __('Recipe Cooking Methods', 'delicious-recipes'),
        'recipe-key': __('Recipe Keys', 'delicious-recipes'),
        'recipe-tag': __('Recipe Tags', 'delicious-recipes'),
        'recipe-badge': __('Recipe Badges', 'delicious-recipes'),
        'recipe-dietary': __('Recipe Dietaries', 'delicious-recipes'),
    };

    const { recipes, list, currentPage, recipesToList } = globalState;

    if (recipes.length > 0 && recipesToList.length === 0) {
        setGlobalState({
            ...globalState,
            recipesToList: recipes.slice((currentPage - 1) * list, currentPage * list),
        });
    }

    return (
        <RecipeContext.Provider value={{ globalState, setGlobalState, wpd_fields }}>
            {children}
        </RecipeContext.Provider>
    );
}

export function useRecipeContext() {
    return useContext(RecipeContext);
}