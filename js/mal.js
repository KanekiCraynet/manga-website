/**
 * MyAnimeList (MAL) Integration JavaScript
 * Version: 1.4
 */

(function($) {
    'use strict';

    // MAL API integration functions
    var MALIntegration = {
        
        // Initialize MAL functionality
        init: function() {
            this.bindEvents();
            this.setupMALFields();
        },

        // Bind event handlers
        bindEvents: function() {
            // Auto-fetch MAL data when MAL ID is entered
            $(document).on('blur', 'input[name*="mal_id"], input[name*="mal-id"]', function() {
                var malId = $(this).val();
                if (malId && malId.length > 0) {
                    MALIntegration.fetchMALData(malId, $(this));
                }
            });

            // Manual fetch button
            $(document).on('click', '.mal-fetch-btn', function(e) {
                e.preventDefault();
                var $button = $(this);
                var $input = $button.siblings('input[name*="mal_id"], input[name*="mal-id"]');
                var malId = $input.val();
                
                if (malId && malId.length > 0) {
                    MALIntegration.fetchMALData(malId, $input);
                } else {
                    alert('Please enter a valid MAL ID');
                }
            });
        },

        // Setup MAL-related form fields
        setupMALFields: function() {
            // Add fetch button if it doesn't exist
            $('input[name*="mal_id"], input[name*="mal-id"]').each(function() {
                if (!$(this).siblings('.mal-fetch-btn').length) {
                    $(this).after('<button type="button" class="button mal-fetch-btn">Fetch from MAL</button>');
                }
            });
        },

        // Fetch data from MAL API
        fetchMALData: function(malId, $input) {
            var $button = $input.siblings('.mal-fetch-btn');
            var originalText = $button.text();
            
            // Show loading state
            $button.text('Fetching...').prop('disabled', true);
            
        // Make AJAX request to fetch MAL data
        $.ajax({
            url: mal_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'fetch_mal_data',
                mal_id: malId,
                nonce: mal_ajax.nonce
            },
                success: function(response) {
                    if (response.success && response.data) {
                        MALIntegration.populateFields(response.data);
                        MALIntegration.showNotice('MAL data fetched successfully!', 'success');
                    } else {
                        MALIntegration.showNotice('Failed to fetch MAL data: ' + (response.data || 'Unknown error'), 'error');
                    }
                },
                error: function(xhr, status, error) {
                    MALIntegration.showNotice('Error fetching MAL data: ' + error, 'error');
                },
                complete: function() {
                    $button.text(originalText).prop('disabled', false);
                }
            });
        },

        // Populate form fields with MAL data
        populateFields: function(data) {
        // Map MAL data to WordPress fields
        var fieldMappings = {
            'title': ['input[name*="title"]', 'input[name*="manga_title"]'],
            'title_english': ['input[name*="nativez"]', 'input[name*="native_title"]'],
            'synopsis': ['textarea[name*="description"]', 'textarea[name*="synopsis"]'],
            'score': ['input[name*="rate"]', 'input[name*="rating"]', 'input[name*="score"]'],
            'status': ['select[name*="status"]', 'input[name*="status"]'],
            'chapters': ['input[name*="total"]', 'input[name*="chapters"]', 'input[name*="episodes"]'],
            'image_url': ['input[name*="thumbnail"]', 'input[name*="cover"]'],
            'mal_id': ['input[name*="mal_id"]', 'input[name*="mal-id"]']
        };

            // Populate fields
            $.each(fieldMappings, function(malField, wpFields) {
                if (data[malField]) {
                    $.each(wpFields, function(index, selector) {
                        var $field = $(selector);
                        if ($field.length) {
                            if ($field.is('select')) {
                                $field.val(data[malField]).trigger('change');
                            } else {
                                $field.val(data[malField]);
                            }
                        }
                    });
                }
            });

            // Handle image URL specially
            if (data.image_url) {
                var $imageField = $('input[name*="thumbnail"], input[name*="cover"]');
                if ($imageField.length) {
                    $imageField.val(data.image_url);
                    // Trigger change event for image preview
                    $imageField.trigger('change');
                }
            }
        },

        // Show admin notice
        showNotice: function(message, type) {
            type = type || 'info';
            var $notice = $('<div class="notice notice-' + type + ' is-dismissible"><p>' + message + '</p></div>');
            
            // Remove existing notices
            $('.notice.mal-notice').remove();
            $notice.addClass('mal-notice');
            
            // Add to admin page
            if ($('#wpbody-content .wrap h1').length) {
                $('#wpbody-content .wrap h1').after($notice);
            } else {
                $('body').prepend($notice);
            }
            
            // Auto-dismiss after 5 seconds
            setTimeout(function() {
                $notice.fadeOut();
            }, 5000);
        },

        // Validate MAL ID format
        validateMALId: function(malId) {
            return /^\d+$/.test(malId);
        },

        // Get MAL URL for a given ID
        getMALUrl: function(malId) {
            return 'https://myanimelist.net/manga/' + malId;
        }
    };

    // Initialize when document is ready
    $(document).ready(function() {
        MALIntegration.init();
    });

    // Expose to global scope for external access
    window.MALIntegration = MALIntegration;

})(jQuery);
