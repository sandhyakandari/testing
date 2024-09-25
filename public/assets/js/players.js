"use strict";

document.addEventListener("DOMContentLoaded", () => {
    const data = [
        {
            categoryName: "Juniors",
            subCategories: ["Under 12", "Under 14", "Under 16", "Under 18"],
        },
        {
            categoryName: "Seniors",
            subCategories: ["Men", "Women"],
        },
    ];

    const categoryElm = document.getElementById("category");
    const subCategoryElm = document.getElementById("subCategory");

    if (categoryElm && subCategoryElm) {

        data.forEach((item) => {
            const option = document.createElement("option");
            option.text = item.categoryName;
            option.value=item.categoryName;
            categoryElm.add(option);
        });


        categoryElm.addEventListener("change", (event) => {
            subCategoryElm.innerHTML = "";
            const selectedCategory = event.target.value;
            const selectedData = data.find(
                (item) => item.categoryName === selectedCategory
            );
            if (selectedData) {
                selectedData.subCategories.forEach((subCategory) => {
                    const option = document.createElement("option");
                    option.text = subCategory;
                    option.value=subCategory;
                    subCategoryElm.add(option);
                });
            }
        });

        // Set default selection
        categoryElm.value = "";
        categoryElm.dispatchEvent(new Event("change"));
    }
});
