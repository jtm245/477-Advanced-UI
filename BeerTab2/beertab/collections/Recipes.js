Recipes = new Mongo.Collection('recipes');

Recipes.allow({
   insert: function(userId, doc) {
       return !!userId;
   } 
});

Ingredient = new SimpleSchema({
    name: {
        type: String,
        label: "Drink Order:"
    },
    amount: {
        type: Number,
        label: "How Many?",
        min: 0
    } 
});

RecipeSchema = new SimpleSchema({
    name: {
        type: String,
        label: "Name"
    },
    Drinks: {
        type: [Ingredient]
    },
    table: {
        type: Number,
        label: "Table #",
        allowedValues: [1,2,3,4,5,6,7,8,9,10],
        autoform: {
            options: [
                {label: "Table 1", value: 1},
                {label: "Table 2", value: 2},
                {label: "Table 3", value: 3},
                {label: "Table 4", value: 4},
                {label: "Table 5", value: 5},
                {label: "Table 6", value: 6},
                {label: "Table 7", value: 7},
                {label: "Table 8", value: 8},
                {label: "Table 9", value: 9},
                {label: "Table 10", value: 10}
            ]
        }
    },
    author: {
        type: String,
        label: "Author",
        autoValue: function() {
            return this.userId
        },
        autoform: {
            type: "hidden"
        }
    },
    createdAt: {
        type: Date,
        label: "Created At",
        autoValue: function() {
            return new Date()
        },
        autoform: {
            type: "hidden"
        }
    }
});

Recipes.attachSchema( RecipeSchema );