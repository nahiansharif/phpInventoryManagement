<!DOCTYPE html>
<html>
<head>
<title>Plane Inspection Form</title>
<style>
body {
    background-color: #6666CC; /* Blue background */
    font-family: sans-serif;
    color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
}

form {
    background-color: #333399; /* Darker blue form background */
    padding: 20px;
    border-radius: 10px;
    width: 400px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

label, input, select, textarea {
    display: block;
    margin-bottom: 10px;
    width: calc(100% - 22px); /* Adjust for padding and border */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box; /* Include padding and border in element's total width and height */
}

select {
    width: calc(100% - 22px); /* Adjust for padding and border */
}

textarea {
    resize: vertical; /* Allow vertical resizing */
    height: 150px;
}

input[type="submit"] {
    background-color: green;
    color: white;
    border: none;
    padding: 15px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
    width: auto;
    align-self: center; /* Center the submit button */
}

input[type="submit"]:hover {
    background-color: #008000; /* Darker green on hover */
}


</style>
</head>
<body>

<form>
    <div class="plane-select">
        <label for="plane">Select a plane for inspection:</label>
        <input type="text" id="plane" name="plane" placeholder="Plane ID">
        <select id="plane-list" name="plane-list">
            <option value="plane1">Plane 1</option>
            <option value="plane2">Plane 2</option>
            <option value="plane3">Plane 3</option>
        </select>
    </div>

    <label for="fuel">Fuel Level in Gallons:</label>
    <input type="number" id="fuel" name="fuel" placeholder="Gallons">

    <label for="tire1">tire 1 condition:</label>
    <select id="tire1" name="tire1">
        <option value="good">Good</option>
        <option value="mediocre">Mediocre</option>
        <option value="bad">Bad</option>
    </select>

    <label for="tire2">tire 2 condition:</label>
    <select id="tire2" name="tire2">
        <option value="good">Good</option>
        <option value="mediocre">Mediocre</option>
        <option value="bad">Bad</option>
    </select>

    <label for="tire3">tire 3 condition:</label>
    <select id="tire3" name="tire3">
        <option value="good">Good</option>
        <option value="mediocre">Mediocre</option>
        <option value="bad">Bad</option>
    </select>

    <label for="tire4">tire 4 condition:</label>
    <select id="tire4" name="tire4">
        <option value="good">Good</option>
        <option value="mediocre">Mediocre</option>
        <option value="bad">Bad</option>
    </select>

    <label for="tire5">tire 5 condition:</label>
    <select id="tire5" name="tire5">
        <option value="good">Good</option>
        <option value="mediocre">Mediocre</option>
        <option value="bad">Bad</option>
    </select>

    <label for="tire6">tire 6 condition:</label>
    <select id="tire6" name="tire6">
        <option value="good">Good</option>
        <option value="mediocre">Mediocre</option>
        <option value="bad">Bad</option>
    </select>

    <label for="engine">Engine Condition:</label>
    <select id="engine" name="engine">
        <option value="good">Good</option>
        <option value="mediocre">Mediocre</option>
        <option value="bad">Bad</option>
    </select>

    <label for="comments">Comments:</label>
    <textarea id="comments" name="comments"></textarea>

    <input type="submit" value="Submit">
</form>

</body>
</html>