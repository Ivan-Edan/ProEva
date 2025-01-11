$(document).ready(function() {

    // Function to display comments and photos in the modal
    function displayCommentsAndPhotos(comments, photos, fullnames) {
        var commentHtml = '';
        var photoHtml = '';

        // Ensure that comments, photos, and fullnames are arrays
        var commentArray = comments ? comments.split(' | ') : [];
        var photoArray = photos ? photos.split(' | ') : [];
        var fullnameArray = fullnames ? fullnames.split(' | ') : [];

        // If there is only one comment, photo, or full name, ensure they are still handled properly
        if (commentArray.length === 1 && commentArray[0] !== '') {
            commentArray = [commentArray[0]]; // Wrap the single comment into an array
            photoArray = [photoArray[0] || '']; // Wrap the single photo into an array (if exists)
            fullnameArray = [fullnameArray[0] || '']; // Wrap the single full name into an array (if exists)
        }

        // Loop through each comment and photo and create corresponding HTML
        commentArray.forEach(function(comment, index) {
            // Check if the comment is not empty or null
            if (comment && comment.trim() !== '') {
                commentHtml += `<p><strong>${fullnameArray[index] || 'Anonymous'}:</strong> ${comment}</p>`;
            }
            
            // Check if the photo exists and add it to the HTML
            if (photoArray[index]) {
                var photoPath = photoArray[index];
                photoHtml += `<a href="${photoPath}" target="_blank">
                                <img src="${photoPath}" alt="Comment photo" class="img-fluid mb-2" style="max-width: 100px; max-height: 100px;" onError="this.onerror=null;this.src='path/to/default-image.jpg';">
                              </a>`;
            }
        });

        // Insert the generated HTML into the modal
        $('#previewContainers').html(commentHtml); // Display the comments
        $('#previewContainersImage').html(photoHtml); // Display the photos
    }

    $('.main-task').click(function() {
        var projectName = $(this).data('project-name');
        var startDate = $(this).data('start-date');
        var endDate = $(this).data('end-date');
        var totalCost = $(this).data('total-cost');
        var fundSource = $(this).data('fund-source');
        var fundingAgency = $(this).data('funding-agency');
        var currentStatus = $(this).data('status');
        var taskId = $(this).data('id');
        var comments = $(this).data('comments');
        var photos = $(this).data('photos');
        var fullnames = $(this).data('fullnames');
        var formattedId = $(this).data('id-formatted');

        function formatDate(dateStr) {
            var date = new Date(dateStr);
            var options = { year: 'numeric', month: 'long', day: '2-digit' };
            return date.toLocaleDateString('en-US', options);
        }

        function formatCost(cost) {
            return Number(cost).toLocaleString();
        }

        console.log('Task ID:', taskId);
        console.log('Comments:', comments);
        console.log('Photos:', photos);

        $('#taskModalLabel').text(projectName);
        $('#startDate').text(formatDate(startDate));
        $('#endDate').text(formatDate(endDate));
        $('#totalCost').text(formatCost(totalCost));
        $('#fundSource').text(fundSource);
        $('#fundingAgency').text(fundingAgency);
        $('#status').text(currentStatus);

        // Display multiple comments and photos
        displayCommentsAndPhotos(comments, photos, fullnames);

        console.log('Formatted Id', formattedId);
        // Store task ID in submit button's data attribute
        $('#submitGantt').data('id', taskId);
        $('#submitGantt').data('id-formatted', formattedId);
        var modal = new bootstrap.Modal(document.getElementById('taskModal'));
        modal.show();
    });
});

$(document).ready(function() {
    // Prevent multiple event bindings
    $('#submitGantt').off('click').on('click', function() {
        var taskId = $(this).data('id');
        var formattedId = $(this).data('id-formatted');
        var comment = $('#commentPrev').val().trim();
        var photo = $('#imagePrev')[0].files[0];

        var formData = new FormData();
        formData.append('id', taskId);
        formData.append('id-formatted', formattedId);
        if (comment) {
            formData.append('comment', comment);
        }
        if (photo) {
            formData.append('photo', photo);
        }

        $.ajax({
            url: 'admin-progress/upload-comment.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                try {
                    const data = JSON.parse(response);
                    if (data.success) {
                        alert(data.message);
                    } else {
                        alert('Failed: ' + data.message);
                    }
                } catch (e) {
                    alert('Error parsing response');
                    console.error(e);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error: ', status, error);
                console.log(xhr.responseText);
                alert('Failed to submit data.');
            }
        });
    });
});

