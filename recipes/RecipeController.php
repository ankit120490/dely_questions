<?php

include_once 'Constants.php';

class RecipeController {
    function getRecipeData(){
        //The function is generic for any json recipe. All we need to do is replace the constant here with the dynamic json for any recipe
        $recipeJson = Constants::recipeData;
        $rawRecipeArray = json_decode($recipeJson, true);
        $recipeArray = array();

        foreach($rawRecipeArray as $key => $value) {
                $value['Name of ingredient'] = strtolower($value['Name of ingredient']);
                $recipeArray[$value['Name of ingredient']]['type'] = 'g';
                
                if($value['Amount used for two serving'] == 'Dash'){
                    $recipeArray[$value['Name of ingredient']]['type'] = 'dash';
                    $recipeArray[$value['Name of ingredient']]['quantity'] = 1;
                } else {
                    foreach(Constants::quantityType as $ingredientType){
                        if (strpos($value['Amount used for two serving'], $ingredientType) !== false) {
                            $recipeArray[$value['Name of ingredient']]['type'] = strtolower($ingredientType);
                            $str = explode($ingredientType,$value['Amount used for two serving']);
                            if (strpos($str[0], '/') !== false) {
                                $numbers = explode('/', $str[0]);
                                $recipeArray[$value['Name of ingredient']]['quantity'] =  round($numbers[0]/$numbers[1],2);
                                
                            } else {
                                $recipeArray[$value['Name of ingredient']]['quantity'] =  floatval($str[0]);
                            }
                            
                        }
                    }
                }
                
                if($recipeArray[$value['Name of ingredient']]['type'] == 'g'){
                    $str = explode('g',$value['Amount used for two serving']);
                    $recipeArray[$value['Name of ingredient']]['quantity'] =  floatval($str[0]);;
                }
        }
        
        return $recipeArray;
    }
    
    function getIngredientData(){
        //The function is generic for any json ingredients. All we need to do is replace the constant here with the dynamic json for ingredients
        $recipeJson = Constants::ingredientData;
        $rawIngredientArray = json_decode($recipeJson, true);
        $ingredientArray = array();
        
        foreach($rawIngredientArray as $key => $value) {
                $value['Name of ingredient'] = strtolower($value['Name of ingredient']);
                $ingredientArray[$value['Name of ingredient']]['type'] = 'g';
                $ingredientArray[$value['Name of ingredient']]['calPer100'] = $value['Calories per 100g'];
                $ingredientArray[$value['Name of ingredient']]['saltPer100'] = $value['Equivalent amount of salt per 100g'];
                $ingredientArray[$value['Name of ingredient']]['actVal'] = 1;
                if(isset($value['Notes'])) {
                    foreach(Constants::quantityType as $ingredientType){
                        if (strpos($value['Notes'], strtolower($ingredientType)) !== false) {
                            $ingredientArray[$value['Name of ingredient']]['type'] = strtolower($ingredientType);
                            $str = explode(' ',$value['Notes']);
                            foreach($str as $explodeVal) {
                                if (preg_match('~[0-9]+~', $explodeVal)) {
                                    $str = explode('g',$explodeVal);
                                    $ingredientArray[$value['Name of ingredient']]['actVal'] =  floatval($str[0]);
                                }
                            }
                            
                        }
                    }
                    
                } 
    
        }
        
        return $ingredientArray;
    }
    
    function getCalorieAndSalt($recipeArray, $ingredientArray) {
        $calorieVal = 0;
        $saltVal = 0;
        $calorieValArray = array();
        $saltValArray = array();
        $calculatedData = array();
        $calculatedData['calorieVal'] = 0;
        $calculatedData['saltVal'] = 0;
        $calculatedData['isError'] = 0;
        $calculatedData['errorMessage'] = 0;
        foreach ($recipeArray as $ingredient => $value){
            if(!isset($ingredientArray[$ingredient])){
                //if any ingredients is missing, the recipe is incomplete and hence the data cannot be calculated.
                $calculatedData['isError'] = 1;
                $calculatedData['errorMessage'] = Constants::ingredientNotPresentError;
                break;
            }
            
            $calorieValArray[$ingredient] = (($value['quantity'] * $ingredientArray[$ingredient]['actVal']) / 100) * $ingredientArray[$ingredient]['calPer100'];
            $saltValArray[$ingredient] = (($value['quantity'] * $ingredientArray[$ingredient]['actVal']) / 100) * $ingredientArray[$ingredient]['saltPer100'];
            $calculatedData['calorieVal'] += $calorieValArray[$ingredient];
            $calculatedData['saltVal'] += $saltValArray[$ingredient];
            
        }
        
        return $calculatedData;
    }
    
    function calculateRecipeCalorieandSalt() {
        
        $recipeArray = $this->getRecipeData();
        $ingredientArray = $this->getIngredientData();
        $calculatedData = $this->getCalorieAndSalt($recipeArray, $ingredientArray);
        if($calculatedData['isError'] == 1) {
            echo $calculatedData['errorMessage'];
        } else {
            echo "Total Calories for the meal is : {$calculatedData['calorieVal']} and total salt for the meal is : {$calculatedData['saltVal']}";
        }
        
    }
    
}
