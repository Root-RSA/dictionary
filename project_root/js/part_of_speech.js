function show(selected) {
    var x = document.getElementById("mySelect").selectedIndex;
    var y = document.getElementById("mySelect").options;
    var selected = y[x].value;

    if (selected === "verb") {
        var s = document.getElementById("verb");      
        s.style.display = "block";
        var x = document.getElementById("noun");      
        x.style.display = "none";
        var x = document.getElementById("adjective");      
        x.style.display = "none";
        var x = document.getElementById("adverb");      
        x.style.display = "none"; 
    } else if (selected === "noun") {
        var s = document.getElementById("verb");      
        s.style.display = "none";
        var x = document.getElementById("noun");      
        x.style.display = "block";
        var x = document.getElementById("adjective");      
        x.style.display = "none";
        var x = document.getElementById("adverb");      
        x.style.display = "none"; 
    } else if (selected === "adjective") {
        var s = document.getElementById("verb");      
        s.style.display = "none";
        var x = document.getElementById("noun");      
        x.style.display = "none";
        var x = document.getElementById("adjective");      
        x.style.display = "block";
        var x = document.getElementById("adverb");      
        x.style.display = "none";
    } else if (selected === "adverb") {
        var s = document.getElementById("verb");      
        s.style.display = "none";
        var x = document.getElementById("noun");      
        x.style.display = "none";
        var x = document.getElementById("adjective");      
        x.style.display = "none";
        var x = document.getElementById("adverb");      
        x.style.display = "block";
    }
}
