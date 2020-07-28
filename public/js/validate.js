$(function() {
    // Handler for .ready() called.
    /** Status Outline
     * 1 => Open
     * 2 => Requested
     * 3 => approved
     * 4 => booked
     * 5 => filled
     * 6 => cancelled
     * 7 => declined
     */

        function ajaxConnect(url,method,data)
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: url,
                method: method,
                data: data,
                success: function(result){
                   alert(result);
                }
            });
        }

        $('.upgrade').click(function(){
            alert('Upgrade Post');
            //ajaxConnect();
        });

        $('.decline').click(function(){
            alert('Decline Request');
            //ajaxConnect();
        });

        $('.confirm').click(function(e){

            var user_id = $(this).attr("user_id");
            var postId = $('#post_id').val();
            var action = 'confirm';

            $(this).removeClass('confirm');
            $(this).html('Booked');

            e.preventDefault();
            //AJAX CALL.....
            ajaxConnect("/post-details/confirm",'POST',{id : user_id, post_id : postId, action : action});

        });

        $('.approve').click(function(e)
        {
            var user_id = $(this).attr("user_id");
            var postId = $('#post_id').val();
            var action = 'approve';

            $(this).removeClass('approve');
            $(this).html('Pending Security Confirmation');

            e.preventDefault();
             //AJAX CALL.....
            ajaxConnect("/post-details/approve",'POST',{id : user_id, post_id : postId, action : action});

        });

        $('.pick_shift').click(function(e)
        {
            var formData = $("#post_id").val();

            $(this).removeClass( "pick_shift" ).addClass( "requested");
            $(this).html("Requested");

            e.preventDefault();
            //AJAX CALL.....
            ajaxConnect("/post-details",'POST',{id : formData});
        });
  });
