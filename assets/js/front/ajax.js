jQuery(document).ready(function () {
    jQuery('body').on('click','a.like-button',function (e) { 
        e.preventDefault();
        let el=jQuery(this);

        let postId=jQuery(el).data('post-id');
        let userId=jQuery(el).data('user-id');
       
   jQuery.ajax({
    type: "post",
    dataType:'JSON',
    url: ls_ajax_plugin.ajaxUrl_ls,
    data:{
        action:'wp_ls_like_post',
        postId:postId,
        userId:userId,
        nonce: ls_ajax_plugin._nonce_ls
    },
    
   
    success: function (response) {
        if(response){
            jQuery.toast({
                heading: 'موفق',
                text: response.message,
                showHideTransition: 'fade',
                icon: 'success'
            })
            jQuery('.like-counter').text(response.likeNumber);
           jQuery('a.like-button').removeClass('like-button').addClass('unlike-button');
        }
    },
    error:function(error){
        if(error){
            jQuery.toast({
                heading: 'خطا',
                text: error.responseJSON.message,
                showHideTransition: 'fade',
                icon: 'error'
            })
        }
    }
   });
        
    });
    jQuery('body').on('click','a.unlike-button',function (e) { 
        e.preventDefault();
        let el=jQuery(this);

        let postId=jQuery(el).data('post-id');
        let userId=jQuery(el).data('user-id');
       
   jQuery.ajax({
    type: "post",
    dataType:'JSON',
    url: ls_ajax_plugin.ajaxUrl_ls,
    data:{
        action:'wp_ls_unlike_post',
        postId:postId,
        userId:userId,
        nonce: ls_ajax_plugin._nonce_ls
    },
    beforeSend:function (){
      //  jQuery('a.unlike-button').removeClass('unlike-button').addClass('like-button');

    },
   
    success: function (response) {
        if(response){
            jQuery.toast({
                heading: 'موفق',
                text: response.message,
                showHideTransition: 'fade',
                icon: 'success'
            })
            jQuery('.like-counter').text(response.likeNumber);
           jQuery('a.unlike-button').removeClass('unlike-button').addClass('like-button');
        }
    },
    error:function(error){
        if(error){
            jQuery.toast({
                heading: 'خطا',
                text: error.responseJSON.message,
                showHideTransition: 'fade',
                icon: 'error'
            })
        }
    }
   });
        
    });
    
});