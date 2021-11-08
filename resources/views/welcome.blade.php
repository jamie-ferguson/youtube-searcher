<!doctype html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</head>
<body>
    <div>
        <input type="text" id="searchTerm" placeholder="search term" />
        <input type="button" class="submit" value="Search" />
    </div>
    <div id="results"></div>

    <script type="text/javascript">
        $(document).ready(function() {

            let dataObj = {};
            $(document).on('click', '.submit', function() {
                // prevent multiple submissions
                let submitButtons = $(".submit");
                submitButtons.attr("disabled", true);

                // alert the user and ask them to add something
                let searchTerm = $('#searchTerm').val().trim();
                if (searchTerm === '') {
                    $('#results').text('Error. Please add a search term.');
                    submitButtons.removeAttr("disabled");
                    return;
                }

                // if prevLink or nextLink
                //      use the original search term
                //      add pagetoken value to payload
                // else
                //      perform a new search using the entered search term
                //      delete pagetoken value from payload
                if ( $(this).attr('id') === 'prevLink' || $(this).attr('id') === 'nextLink' ) {
                    dataObj.pagetoken = $(this).data("token");
                } else {
                    dataObj.searchterm = searchTerm;
                    if (dataObj.pagetoken !== undefined) {
                        delete dataObj.pagetoken;
                    }
                }

                // send the ajax request to the BE
                $.ajax({
                    type: "GET",
                    url: 'search',
                    data: dataObj,
                    success: function(response)
                    {
                        // render the results view to the user
                        $('#results').html( response );
                    },
                    error: function (request, status, error)
                    {
                        // alert the user and ask them to try again
                        $('#results').text('Error. Please try again.');
                    },
                    complete: function()
                    {
                        // re-enable the submit buttons
                        submitButtons.removeAttr("disabled");
                    },
                });
            });
        });
    </script>
</body>
</html>
