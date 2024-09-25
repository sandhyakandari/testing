"use strict";

document.addEventListener("DOMContentLoaded", function() {
    const dragArea = document.querySelector(".dragArea");

    function fnDragStart(e) {
        // console.log("Item drag start");
        e.target.classList.add("is-drag-start");
    }

    function fnDragEnd(e) {
        // console.log("Item drag end");
        e.target.classList.remove("is-drag-start");
    }

    function fnDragEnter(e) {
        e.preventDefault();
        // console.log("Drag enter");
        e.target.classList.add("selected");
    }

    function fnDragLeave(e) {
        // console.log("Drag leave");
        e.target.classList.remove("selected");
    }

    function fnDragOver(e) {
        e.preventDefault(); 
        // console.log("Drag over");
    }

    function fnDragDrop(e) {
        e.preventDefault();
        // console.log("Item dropped");

        const draggedItem = document.querySelector(".is-drag-start");

        // Ensure the drop target is a valid dragItem
        let destination = e.target;
        while (destination && !destination.classList.contains("dragItem")) {
            destination = destination.parentElement;
        }

        if (!destination) {
            // console.log("Invalid drop target");
            return;
        }

        if (draggedItem && draggedItem !== destination) {
            const childrenArray = [...dragArea.children];
            const initialPosition = childrenArray.indexOf(draggedItem);
            const destinationPosition = childrenArray.indexOf(destination);

            // console.log("Initial Position: ", initialPosition);
            // console.log("Destination Position: ", destinationPosition);

            if (initialPosition > destinationPosition) {
                destination.before(draggedItem);
            } else if (initialPosition < destinationPosition) {
                destination.after(draggedItem);
            }
        }
    }

    dragArea.addEventListener("dragstart", fnDragStart);
    dragArea.addEventListener("dragend", fnDragEnd);
    dragArea.addEventListener("dragenter", fnDragEnter);
    dragArea.addEventListener("dragleave", fnDragLeave);
    dragArea.addEventListener("dragover", fnDragOver);
    dragArea.addEventListener("drop", fnDragDrop);

    // set checkbox value
    const byCheckboxElm = document.querySelectorAll(".by-checkbox");

    byCheckboxElm.forEach(elm => {
        elm.value = elm.checked ? "yes" : "no";
        
        elm.addEventListener("change", function(event) {
            event.target.value = event.target.checked ? "yes" : "no";
            event.target.nextElementSibling.value=event.target.checked?"yes":"no";
            // console.log("event.target.nextElementSibling value: ", event.target.nextElementSibling.value)
            // console.log(event.target.value);
            // console.log("event.target.nextElementSibling", event.target.nextElementSibling)
        });
    });
});
