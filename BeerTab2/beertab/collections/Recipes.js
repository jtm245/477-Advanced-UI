Recipes = new Mongo.Collection('recipes');

Recipes.allow({
   insert: function(userId, doc) {
       return !!userId;
   },
   update: function(userId, doc) {
       return !!userId;
   }
});

Ingredient = new SimpleSchema({
    name: {
        type: String,
        label: "Drink Order:",
        allowedValues: ["Bud (16oz)","Bud (24oz)","House Margarita","Cadillac Margarita",
                        "Jack/Coke (Short)","Jack/Coke (Tall)","Whiskey Sour (Short)",
                        "Whiskey Sour (Tall)","Tequila (Shot)","Rum (Shot)", "Vodka (shot)"],
        autoform: {
            options: [
                {label: "Bud - 16oz", value: "Bud (16oz)"},
                {label: "Bud - 24oz", value: "Bud (24oz)"},
                {label: "House Margarita", value: "House Margarita"},
                {label: "Cadillac Margarita", value: "Cadillac Margarita"},
                {label: "Jack/Coke - Short", value: "Jack/Coke (Short)"},
                {label: "Jack/Coke - Tall", value: "Jack/Coke (Tall)"},
                {label: "Whiskey Sour - Short", value: "Whiskey Sour (Short)"},
                {label: "Whiskey Sour - Tall", value: "Whiskey Sour (Tall)"},
                {label: "Tequila - Shot", value: "Tequila (Shot)"},
                {label: "Rum - Shot", value: "Rum (Shot)"},
				{label: "Vodka - Shot", value: "Vodka (Shot)"}
            ]
        }
    },
    amount: {
        type: Number,
        label: "How Many?",
        min: 0
    } ,
    cost: {
        type: Number,
        label: "Price per Unit: $",
        allowedValues: [2.00,3.00,4.00,5.00,6.00,7.00,8.00,9.00,10.00]
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

Meteor.methods({
    toggleMenuItem: function(id, currentState) {
        Recipes.update(id, {
            $set: {
                inMenu: !currentState
            }
        });
    }
});

Recipes.attachSchema( RecipeSchema );
