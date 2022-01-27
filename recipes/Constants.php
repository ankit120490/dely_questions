<?php
      
class Constants {
    const recipeData = '[{"Name of ingredient":"Bean sprouts","Amount used for two serving":"100g"},{"Name of ingredient":"Pea sprouts","Amount used for two serving":"1pack"},{"Name of ingredient":"Pork belly","Amount used for two serving":"150g"},{"Name of ingredient":"Salt and pepper","Amount used for two serving":"Dash"},{"Name of ingredient":"Soy sauces","Amount used for two serving":"1Tablespoon"},{"Name of ingredient":"Chicken soup stock","Amount used for two serving":"1/2Teaspoon"},{"Name of ingredient":"White sesame seed","Amount used for two serving":"1Tablespoon"},{"Name of ingredient":"Chinese chili oil","Amount used for two serving":"1/2Teaspoon"}]';
    const ingredientData = '[{"Name of ingredient":"Bean sprouts","Calories per 100g":14,"Equivalent amount of salt per 100g":0},{"Name of ingredient":"Pea sprouts","Calories per 100g":27,"Equivalent amount of salt per 100g":0,"Notes":"100g per pack"},{"Name of ingredient":"Pork belly","Calories per 100g":395,"Equivalent amount of salt per 100g":0.1},{"Name of ingredient":"Salt and pepper","Calories per 100g":116,"Equivalent amount of salt per 100g":66,"Notes":"A dash indicates 0.5g"},{"Name of ingredient":"Soy sauces","Calories per 100g":71,"Equivalent amount of salt per 100g":14.5,"Notes":"18.0g per tablespoon"},{"Name of ingredient":"Chicken soup stock","Calories per 100g":211,"Equivalent amount of salt per 100g":47.5,"Notes":"2g per teaspoon"},{"Name of ingredient":"White sesame seed","Calories per 100g":599,"Equivalent amount of salt per 100g":0,"Notes":"9g per tablespoon"},{"Name of ingredient":"Chinese chili oil","Calories per 100g":919,"Equivalent amount of salt per 100g":0,"Notes":"4g per teaspoon"}]';
    const quantityType = array(
       'Dash' ,'Tablespoon', 'Teaspoon', 'pack');
    const ingredientNotPresentError = "Ingredient is not Present in the ingredient JSON";
    
}
