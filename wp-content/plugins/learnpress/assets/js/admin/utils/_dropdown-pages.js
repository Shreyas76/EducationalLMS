;(function ($) {
    function dropdownPages(el, options) {
        this.options = $.extend({
            ID: '',
            name: 'Add new page'
        }, options || {});
        var $element = $(el),
            $select = $element.find('select'),
            $listWrap = $element.find('.list-pages-wrapper'),
            $actions = $element.find('.quick-add-page-actions'),
            $form = $element.find('.quick-add-page-inline');

        function addNewPageToList(args) {
            var $new_option = $('<option value="' + args.ID + '">' + args.name + '</option>');
            var position = $.inArray(args.ID + "", args.positions);

            $('.learn-press-dropdown-pages select').each(function(){
                var $sel = $(this),
                    $option = $new_option.clone();
                if (position == 0) {
                    $('option', $sel).each(function () {
                        if (parseInt($(this).val())) {
                            $option.insertBefore($(this));
                            return false;
                        }
                    })
                } else if (position == args.positions.length - 1) {
                    $sel.append($option);
                } else {
                    $option.insertAfter($('option[value="' + args.positions[position - 1] + '"]', $sel));
                }
            });
        }

        $select.change(function () {

            $actions.addClass('hide-if-js');
            if (this.value !== 'add_new_page') {
                if (parseInt(this.value)) {
                    $actions.find('a.edit-page').attr('href', 'post.php?post=' + this.value + '&action=edit');
                    $actions.find('a.view-page').attr('href', lpGlobalSettings.siteurl + '?page_id=' + this.value);
                    $actions.removeClass('hide-if-js');
                    $select.attr('data-selected', this.value);
                }
                return;
            }
            $listWrap.addClass('hide-if-js');
            $form.removeClass('hide-if-js').find('input').focus().val('');
        });

        // Select 2
        $select
            .css('width', $select.width() + 50)
            .find('option').each(function () {
            $(this).html($(this).html().replace(/&nbsp;&nbsp;&nbsp;/g, ''));
        });

        $select.select2({
            allowClear: true
        });

        $select.on('select2:select', function (e) {
            var data = e.params.data;
        });

        $element.on('click', '.quick-add-page-inline button', function () {
            var $button = $(this),
                $input = $form.find('input'),
                page_name = $input.val();
            if (!page_name) {
                alert('Please enter the name of page');
                $input.focus();
                return;
            }
            $button.prop('disabled', true);
            $.ajax({
                url: lpGlobalSettings.ajax,
                data: {
                    action: 'learnpress_create_page',
                    page_name: page_name
                },
                type: 'post',
                dataType: 'html',
                success: function (response) {
                    response = LP.parseJSON(response);
                    if (response.page) {
                        addNewPageToList({
                            ID: response.page.ID,
                            name: response.page.post_title,
                            positions: response.positions
                        });
                        $select.val(response.page.ID).focus().trigger('change');
                        $form.addClass('hide-if-js');
                    } else if (response.error) {
                        alert(response.error);
                    }
                    $button.prop('disabled', false);
                    $listWrap.removeClass('hide-if-js');
                }
            });
        }).on('click', '.quick-add-page-inline a', function (e) {
            e.preventDefault();
            $form.addClass('hide-if-js');
            $select.val($select.attr('data-selected') + '').removeAttr('disabled').trigger('change');
            $listWrap.removeClass('hide-if-js');
        }).on('click', '.button-quick-add-page', function (e) {
            $select.val('add_new_page').trigger('change');
        }).on('keypress keydown', '.quick-add-page-inline input[type="text"]', function (e) {
            if (e.keyCode == 13 && e.type == 'keypress') {
                e.preventDefault();
                $(this).siblings('button').trigger('click')
            } else if (e.keyCode == 27 && e.type == 'keydown') {
                $(this).siblings('a').trigger('click')
            }
        })
    }

    $.fn.dropdownPages = function () {
        return $.each(this, function () {
            var $instance = $(this).data('dropdownPages');
            if (!$instance) {
                $instance = new dropdownPages(this, {});
                $(this).data('dropdownPages', $instance);
            }
            return $instance;
        })
    }
})(jQuery);


