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
        importCSVFileID: '',
        importCSVFileName: '',
        importCSVFileURL: '',
        importCSVFileSize: '',
        CSVFileHeaders : [],
        CSVFields: [],
        isCSV: false,
        deleteCSV: false,
    });

        const recipe_metadata = {
        // Post Info
        'recipeTitle': { value: 'recipeTitle', label: __('Recipe Title', 'delicious-recipes'), section: 'Post Info' },
        'postContent': { value: 'postContent', label: __('Post Content', 'delicious-recipes'), section: 'Post Info' },
        'postExcerpt': { value: 'postExcerpt', label: __('Post Excerpt', 'delicious-recipes'), section: 'Post Info' },
        'featuredImage': { value: 'featuredImage', label: __('Featured Image', 'delicious-recipes'), section: 'Post Info' },
        'recipeAuthor': { value: 'recipeAuthor', label: __('Recipe Author', 'delicious-recipes'), section: 'Post Info' },
        'recipeAuthorEmail': { value: 'recipeAuthorEmail', label: __('Recipe Author Email', 'delicious-recipes'), section: 'Post Info' },
        'commnetStatus': { value: 'commnetStatus', label: __('Comment Status', 'delicious-recipes'), section: 'Post Info' },
        // Recipe Info
        'recipeSubtitle': { value: 'recipeSubtitle', label: __('Recipe Subtitle', 'delicious-recipes'), section: 'Recipe Info' },
        'recipeDescription': { value: 'recipeDescription', label: __('Recipe Description', 'delicious-recipes'), section: 'Recipe Info' },
        'difficultyLevel': { value: 'difficultyLevel', label: __('Difficulty Level', 'delicious-recipes'), section: 'Recipe Info' },
        'prepTime': { value: 'prepTime', label: __('Prep Time', 'delicious-recipes'), section: 'Recipe Info' },
        'cookTime': { value: 'cookTime', label: __('Cook Time', 'delicious-recipes'), section: 'Recipe Info' },
        'restTime': { value: 'restTime', label: __('Rest Time', 'delicious-recipes'), section: 'Recipe Info' },
        'cookingTemp': { value: 'cookingTemp', label: __('Cooking Temperature', 'delicious-recipes'), section: 'Recipe Info' },
        'recipeCalories': { value: 'recipeCalories', label: __('Recipe Calories', 'delicious-recipes'), section: 'Recipe Info' },
        'bestSeason': { value: 'bestSeason', label: __('Best Season', 'delicious-recipes'), section: 'Recipe Info' },
        'estimatedCost': { value: 'estimatedCost', label: __('Estimated Cost', 'delicious-recipes'), section: 'Recipe Info' },
        // Ingredients
        'noOfServings': { value: 'noOfServings', label: __('Number of Servings', 'delicious-recipes'), section: 'Ingredients' },
        'ingredientTitle': { value: 'ingredientTitle', label: __('Ingredient Title', 'delicious-recipes'), section: 'Ingredients' },
        'ingredients': { value: 'ingredients', label: __('Ingredients', 'delicious-recipes'), section: 'Ingredients' },
        // Instructions
        'instructionTitle': { value: 'instructionTitle', label: __('Instruction Title', 'delicious-recipes'), section: 'Instructions' },
        'instructions': { value: 'instructions', label: __('Instructions', 'delicious-recipes'), section: 'Instructions' },
        // Gallery
        'imageGallery': { value: 'imageGallery', label: __('Image Gallery', 'delicious-recipes'), section: 'Gallery' },
        'videoGallery': { value: 'videoGallery', label: __('Video Gallery', 'delicious-recipes'), section: 'Gallery' },
        // Nutrition
        'servingSize': { value: 'servingSize', label: __('Serving Size', 'delicious-recipes'), section: 'Nutrition' },
        'calories': { value: 'calories', label: __('Calories', 'delicious-recipes'), section: 'Nutrition' },
        'totalFat': { value: 'totalFat', label: __('Total Fat', 'delicious-recipes'), section: 'Nutrition' },
        'saturatedFat': { value: 'saturatedFat', label: __('Saturated Fat', 'delicious-recipes'), section: 'Nutrition' },
        'transFat': { value: 'transFat', label: __('Trans Fat', 'delicious-recipes'), section: 'Nutrition' },
        'cholesterol': { value: 'cholesterol', label: __('Cholesterol', 'delicious-recipes'), section: 'Nutrition' },
        'sodium': { value: 'sodium', label: __('Sodium', 'delicious-recipes'), section: 'Nutrition' },
        'potassium': { value: 'potassium', label: __('Potassium', 'delicious-recipes'), section: 'Nutrition' },
        'totalCarbohydrate': { value: 'totalCarbohydrate', label: __('Total Carbohydrate', 'delicious-recipes'), section: 'Nutrition' },
        'dietaryFiber': { value: 'dietaryFiber', label: __('Dietary Fiber', 'delicious-recipes'), section: 'Nutrition' },
        'sugars': { value: 'sugars', label: __('Sugars', 'delicious-recipes'), section: 'Nutrition' },
        'protein': { value: 'protein', label: __('Protein', 'delicious-recipes'), section: 'Nutrition' },
        'vitaminA': { value: 'vitaminA', label: __('Vitamin A', 'delicious-recipes'), section: 'Nutrition' },
        'vitaminC': { value: 'vitaminC', label: __('Vitamin C', 'delicious-recipes'), section: 'Nutrition' },
        'vitaminD': { value: 'vitaminD', label: __('Vitamin D', 'delicious-recipes'), section: 'Nutrition' },
        'vitaminE': { value: 'vitaminE', label: __('Vitamin E', 'delicious-recipes'), section: 'Nutrition' },
        'vitaminK': { value: 'vitaminK', label: __('Vitamin K', 'delicious-recipes'), section: 'Nutrition' },
        'vitaminB6': { value: 'vitaminB6', label: __('Vitamin B6', 'delicious-recipes'), section: 'Nutrition' },
        'vitaminB12': { value: 'vitaminB12', label: __('Vitamin B12', 'delicious-recipes'), section: 'Nutrition' },
        'calcium': { value: 'calcium', label: __('Calcium', 'delicious-recipes'), section: 'Nutrition' },
        'iron': { value: 'iron', label: __('Iron', 'delicious-recipes'), section: 'Nutrition' },
        'thiamin': { value: 'thiamin', label: __('Thiamin', 'delicious-recipes'), section: 'Nutrition' },
        'riboflavin': { value: 'riboflavin', label: __('Riboflavin', 'delicious-recipes'), section: 'Nutrition' },
        'niacin': { value: 'niacin', label: __('Niacin', 'delicious-recipes'), section: 'Nutrition' },
        'folate': { value: 'folate', label: __('Folate', 'delicious-recipes'), section: 'Nutrition' },
        'biotin': { value: 'biotin', label: __('Biotin', 'delicious-recipes'), section: 'Nutrition' },
        'pantothenicAcid': { value: 'pantothenicAcid', label: __('Pantothenic Acid', 'delicious-recipes'), section: 'Nutrition' },
        'phosphorus': { value: 'phosphorus', label: __('Phosphorus', 'delicious-recipes'), section: 'Nutrition' },
        'iodine': { value: 'iodine', label: __('Iodine', 'delicious-recipes'), section: 'Nutrition' },
        'magnesium': { value: 'magnesium', label: __('Magnesium', 'delicious-recipes'), section: 'Nutrition' },
        'zinc': { value: 'zinc', label: __('Zinc', 'delicious-recipes'), section: 'Nutrition' },
        'selenium': { value: 'selenium', label: __('Selenium', 'delicious-recipes'), section: 'Nutrition' },
        'copper': { value: 'copper', label: __('Copper', 'delicious-recipes'), section: 'Nutrition' },
        'manganese': { value: 'manganese', label: __('Manganese', 'delicious-recipes'), section: 'Nutrition' },
        'chromium': { value: 'chromium', label: __('Chromium', 'delicious-recipes'), section: 'Nutrition' },
        'molybdenum': { value: 'molybdenum', label: __('Molybdenum', 'delicious-recipes'), section: 'Nutrition' },
        'chloride': { value: 'chloride', label: __('Chloride', 'delicious-recipes'), section: 'Nutrition' },
        // Notes
        'recipeNotes': { value: 'recipeNotes', label: __('Recipe Notes', 'delicious-recipes'), section: 'Notes' },
        // FAQs
        'faqTitle': { value: 'faqTitle', label: __('FAQ Title', 'delicious-recipes'), section: 'FAQs' },
        'recipeFAQs': { value: 'recipeFAQs', label: __('Recipe FAQs', 'delicious-recipes'), section: 'FAQs' },
        // Equipment
        'equipmentsTitle': { value: 'equipmentsTitle', label: __('Equipment Title', 'delicious-recipes'), section: 'Equipment' },
        'recipeEquipments': { value: 'recipeEquipments', label: __('Recipe Equipment', 'delicious-recipes'), section: 'Equipment' },
        // Extended Content
        'extendedContent': { value: 'extendedContent', label: __('Extended Content', 'delicious-recipes'), section: 'Extended Content' },
    }

    const wpd_fields = {
        // Taxonomies
        'recipe-course': __('Recipe Courses', 'delicious-recipes'),
        'recipe-cuisine': __('Recipe Cuisines', 'delicious-recipes'),
        'recipe-cooking-method': __('Recipe Cooking Methods', 'delicious-recipes'),
        'recipe-key': __('Recipe Keys', 'delicious-recipes'),
        'recipe-tag': __('Recipe Tags', 'delicious-recipes'),
        'recipe-badge': __('Recipe Badges', 'delicious-recipes'),
        'recipe-dietary': __('Recipe Dietaries', 'delicious-recipes'),
        // Recipe Keywords (SEO)
        'recipe_keywords': __('Recipe Keywords', 'delicious-recipes'),
    };

    const { recipes, list, currentPage, recipesToList } = globalState;

    if (recipes?.length > 0 && recipesToList.length === 0) {
        setGlobalState({
            ...globalState,
            recipesToList: recipes.slice((currentPage - 1) * list, currentPage * list),
        });
    }

    return (
        <RecipeContext.Provider value={{ globalState, setGlobalState, recipe_metadata, wpd_fields }}>
            {children}
        </RecipeContext.Provider>
    );
}

export function useRecipeContext() {
    return useContext(RecipeContext);
}