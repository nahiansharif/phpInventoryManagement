alert("hellovdfvdbfbgfgb"); 

const inputElement = document.getElementById("search-bar"); 
const headerElement = document.getElementById("headerName"); 

inputElement.addEventListener("input", function(){
    let inputVal = inputElement.value; 
    headerElement.textContent = inputVal; 
})














