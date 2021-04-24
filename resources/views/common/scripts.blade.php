<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
    var counter = 1;
    function addAnotherBlock() {
        // Disable Add Another URL
        document.getElementById("add-url").disabled = true;

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
        document.getElementById("add-url").disabled = false;
    }

    function startCrawling() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log('Success');
            }
        };
        xhttp.open("POST", `{{ route('search.store') }}`, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send();
    }
</script>