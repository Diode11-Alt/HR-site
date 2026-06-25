/* global jQuery, pp_ajax */
jQuery(document).ready(function($) {
    
    // Update Job Status
    $('.pp-job-status-select').on('change', function() {
        var select = $(this);
        var jobId = select.data('id');
        var status = select.val();
        
        select.prop('disabled', true);
        
        $.ajax({
            url: pp_ajax.url,
            type: 'POST',
            data: {
                action: 'pp_admin_update_job_status',
                pp_nonce: pp_ajax.nonce,
                job_id: jobId,
                status: status
            },
            success: function(res) {
                if(res.success) {
                    location.reload();
                } else {
                    alert(res.data || 'Failed to update status.');
                    select.prop('disabled', false);
                }
            },
            error: function() {
                alert('Network Error');
                select.prop('disabled', false);
            }
        });
    });

    // Delete Inquiry
    $('.pp-delete-inquiry').on('click', function() {
        if(!confirm('Delete this inquiry?')) return;
        var btn = $(this);
        var id = btn.data('id');
        
        $.ajax({
            url: pp_ajax.url,
            type: 'POST',
            data: {
                action: 'pp_admin_delete_inquiry',
                pp_nonce: pp_ajax.nonce,
                id: id
            },
            success: function(res) {
                if(res.success) {
                    btn.closest('tr').fadeOut();
                } else {
                    alert('Failed to delete.');
                }
            }
        });
    });

});
