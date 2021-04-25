<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
    // Global Counter Variable to check the number of div block created
    var counter = 1;
    
    /* 
    Function to add another div block which contain label and input box.
    */
    function addAnotherBlock() {
        document.getElementById("loader").style.display = "block";
        // Disable Add Another URL
        document.getElementById("add-url").disabled = true;
        document.getElementById("crawling-btn").disabled = true;

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
        document.getElementById("crawling-btn").disabled = false;
        document.getElementById("loader").style.display = "none";
    }

    /*
    Function to send request of list of URL's and get response once it's crawled.
    */
    function startCrawling() {
        document.getElementById("loader").style.display = "block";
        // Disable Start Crawling URL Button
        document.getElementById("crawling-btn").disabled = true;
        document.getElementById("add-url").disabled = true;
        
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Creation and selection of elements
                var referenceNode = document.querySelector(`.block-${counter}`);
                var result = JSON.parse(this.responseText);
                var removeChild = document.querySelector('.result');
                var newDiv = document.createElement('div');
                var newParagraph = document.createElement('p');
                
                /* 
                Removal of child messages if present. Suppose if you've done the
                crawling first time successfully then the message will be successfully
                crawled but if you again send different set of URL and that particular is
                failed then the success message will be removed and error message will show.
                Basically, I am removing child.
                */
                while(removeChild.firstChild) {
                    removeChild.removeChild(removeChild.firstChild);
                }

                // Check if the crawling is success or not.
                if (result.status == 200) {
                    newDiv.classList.add("center");
                    newParagraph.innerHTML = 'Successfully Crawled '+counter+' pages';
                    newDiv.appendChild(newParagraph);
                    referenceNode.after(newDiv);
                    document.getElementById("add-url").disabled = false;
                    document.getElementById("crawling-btn").disabled = false;
                    document.getElementById("loader").style.display = "none";
                } else {
                    newDiv.classList.add("center");
                    newParagraph.innerHTML = 'Successfully Crawled '+counter+' pages';
                    newDiv.appendChild(newParagraph);
                    referenceNode.after(newDiv);
                    document.getElementById("add-url").disabled = false;
                    document.getElementById("crawling-btn").disabled = false;
                    document.getElementById("loader").style.display = "none";
                }
            }
        };

        xhttp.open("POST", `{{ route('search.store') }}`, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var arrayOfURL = [];

        // Looping all the input value and sending via xhttp request
        for (let i = 1; i <= counter; i++) {
            arrayOfURL.push(document.getElementsByName(`url-${i}`)[0].value);
        }
        xhttp.send(`url=${arrayOfURL}`);
    }
    
    /*
    Event listener to listen to keydown stroke on the search bar.
    */
    document.getElementById("search-word").addEventListener("keydown", function(event) {
        if (event.keyCode == 13){
            search();
        }
    }, false);

    /*
    Search function to send request of search keywords and get response as URL and Title
    */
    function search() {
        document.getElementById("loader").style.display = "block";
        // Disable Start Crawling URL Button
        document.getElementById("search-btn").disabled = true;
        
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Creation and selection of elements
                var result = JSON.parse(this.responseText);
                var removeChild = document.querySelector('.result');
                var newDiv = document.createElement('div');
                var newParagraph = document.createElement('p');
                var newAnchor = document.createElement('a');
                document.getElementById("search-btn").disabled = false;
                document.getElementById("loader").style.display = "none";
                /* 
                Removal of child messages if present. Suppose if you've done the
                crawling first time successfully then the message will be successfully
                crawled but if you again send different set of URL and that particular is
                failed then the success message will be removed and error message will show.
                Basically, I am removing child.
                */
                while(removeChild.firstChild) {
                    removeChild.removeChild(removeChild.firstChild);
                }

                // Check if the crawling is success or not.
                if (result.status == 200) {
                    for (const data of result.data) {
                        document.getElementById('result').innerHTML += '<div>'+
                        "<a href="+ data.url +" target=_blank><p>" + data.title + 
                        "</p>" + "</a>" +
                        '</div>';
                    }
                    document.getElementById("search-btn").disabled = false;
                    document.getElementById("loader").style.display = "none";
                } else {
                    newDiv.classList.add("center");
                    newParagraph.innerHTML = 'Error in searching';
                    newDiv.appendChild(newParagraph);
                    document.getElementById("search-btn").disabled = false;
                    document.getElementById("loader").style.display = "none";
                }
            }
        };

        xhttp.open("POST", `{{ route('search.result') }}`, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var value = document.getElementsByName('search-word')[0].value
        xhttp.send(`search=${value}`);
    }
</script>