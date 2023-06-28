$(document).ready(function() {
    // Reference the search input and results elements
    var searchInput = $('#search-input');
    var searchResults = $('#search-results');
  
    // Attach an event handler to the search input
    searchInput.on('keyup', function() {
      var searchText = searchInput.val();
  
      // Check if the search text length is at least 2 characters
      if (searchText.length >= 2) {
        // Send an AJAX request to the PHP API
        $.ajax({
          url: '/search-email',
          method: 'GET',
          data: { search: searchText },
          success: function(response) {
            // Clear previous search results
            searchResults.empty();
  
            // Process the API response and update the search results
            if (response.length > 0) {
              for (var i = 0; i < response.length; i++) {
                // Create list items for each search result
                var listItem = $('<li>').text(response[i]);
                searchResults.append(listItem);
              }
              // Attach a click event handler to the dynamically created <li> elements
            searchResults.on('click', 'li', function() {
                var selectedResult = $(this).text();
                // Handle the click event for the selected result
                console.log('Clicked on: ' + selectedResult);
                searchInput.val(selectedResult);
                // Submit the form
                $('#search-form').submit();
            });

            } else {
              // Handle no results scenario
              var listItem = $('<li>').text('No results found');
              searchResults.append(listItem);
            }
          },
          error: function() {
            // Handle error scenario
            searchResults.empty();
            var listItem = $('<li>').text('Error occurred');
            searchResults.append(listItem);
          }
        });
      } else {
        // Clear search results if the search text is less than 2 characters
        searchResults.empty();
      }
    });

    //-------------- code to submit form
    $('.pay_option').click(function(){
      $(this).find('form').submit();
    });

  });
  