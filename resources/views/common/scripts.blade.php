<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
    var counter = 1;
    function addAnotherBlock() {
        // Disable Add Another URL
        document.getElementById("addURL").disabled = true;

        // Creation and selection of elements
        var newDiv = document.createElement('div');
        var newLabel = document.createElement('label');
        var newInput = document.createElement('input');
        var referenceNode = document.querySelector(`.block-${counter}`);
        
        // Making count and marking div class name and input name
        counter++;
        
        // Addition of class, name, type and text content. 
        newDiv.classList.add("center");
        newDiv.classList.add('block-'+counter);
        newLabel.innerHTML = 'Enter the URL';
        newInput.type = 'text';
        newInput.name = 'url-'+counter;
        
        // Append label and input inside div element
        newDiv.appendChild(newLabel);
        newDiv.appendChild(newInput);

        // Insertion of div below the previous div
        referenceNode.after(newDiv);

        // Enable Add Another URL Button
        document.getElementById("addURL").disabled = false;
    }
</script>