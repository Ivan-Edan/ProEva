$(document).ready(function() {    // Function to display comments and photos in the modal
    function displayCommentsAndPhotosSub(comments, photos, fullnames) {
        var commentHtml = '';
        var photoHtml = '';

        console.log("123 triggred");
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

        console.log("test");
        // Loop through each comment and photo and create corresponding HTML
        commentArray.forEach(function(comment, index) {
            // Check if the comment is not empty or null
            if (comment && comment.trim() !== '') {
                commentHtml += `<p><strong>${fullnameArray[index] || 'Anonymous'}:</strong> ${comment}</p>`;
            }
            console.log("test1");

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

    $('.subtask-name').click(function() {
        var subProjectName = $(this).data('subproject-name');
        var subStartDate = $(this).data('substart-date');
        var subEndDate = $(this).data('subend-date');
        var subTotalCost = $(this).data('subtotal-cost');
        var subFundSource = $(this).data('subfund-source');
        var subFundingAgency = $(this).data('subfunding-agency');
        var subCurrentStatus = $(this).data('substatus');
        var subTaskId = $(this).data('id');
        var formattedId = $(this).data('id-formatted');
        var comments = $(this).data('subcomments');
        var photos = $(this).data('subphotos');
        var fullnames = $(this).data('subfullnames');

        function formatDate(dateStr) {
            var date = new Date(dateStr);
            var options = { year: 'numeric', month: 'long', day: '2-digit' };
            return date.toLocaleDateString('en-US', options);
        }

        function formatCost(cost) {
            return Number(cost).toLocaleString();
        }

        console.log('Subtask ID:', subTaskId);
        console.log('Subtask Comments:', comments);
        console.log('Subtask Photos:', photos);

        $('#taskModalLabel').text(subProjectName);
        $('#startDate').text(formatDate(subStartDate));
        $('#endDate').text(formatDate(subEndDate));
        $('#totalCost').text(formatCost(subTotalCost));
        $('#fundSource').text(subFundSource);
        $('#fundingAgency').text(subFundingAgency);
        $('#status').text(subCurrentStatus);

        // Display multiple comments and photos
        displayCommentsAndPhotosSub(comments, photos, fullnames);

        // Store subtask ID in submit button's data attribute
        $('#submitGantt').data('id', subTaskId);
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
            url: 'admin-progress/upload-comment-sub.php',
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