$(document).ready(function()
  {
  $('a[delete]').click(function (e) {
    e.preventDefault();
    id = $(this).attr('delete');
    $.post('pages.php', { 'delete' : id });
    row = 'tr#' + id;
    $(row).fadeOut();
    });
  
  $('a[rename]').click(function (e) {
    e.preventDefault();
    id = $(this).attr('rename');
    name = $(this).attr('name');
    row = 'tr#' + id + ' a.name'; 
    $(row).replaceWith('<form action="pages.php" method="post" id="rename"><input type="text" id="rename" name="rename" value="' + name +'"/><input type="hidden" id="id" name="id" value="' + id +'" /><input type="submit" name="submit" value="Rename" /></form>');
    });
  
  $('input.hint').blur(function() {
    if($(this).val() == '' && $(this).attr('title') != ''){ 
      $(this).val($(this).attr('title'));
      $(this).addClass('hint'); 
      }
    }); 
  
  $('input.hint').focus(function() {
    if($(this).val() == $(this).attr('title')){ 
      $(this).val('');
      $(this).removeClass('hint');
      }
    });  
        
  $('input.hint').each(function() {
    if($(this).attr('title') == ''){ return; }
    if($(this).val() == ''){ $(this).val($(this).attr('title')); }
    else { $(this).removeClass('hint'); } 
  });

  $('textarea#page_content').ckeditor(function() { }, {
    contentsCss : 'js/ckeditor/style-pages.css',
    forcePasteAsPlainText : true,
    height : '280',
    resize_dir : 'vertical',
    toolbar : [ [ 'Undo', 'Redo', '-', 'Maximize'], [ 'Bold', 'Italic', 'Underline', 'Strike Through', 'Subscript', 'Superscript' ], [ 'TextColor','BGColor' ], [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ], [ 'Link','Unlink','Anchor' ], [ 'Image','Flash','Table','SpecialChar' ], [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ], '/', [ 'Format','Font','FontSize' ] , [ 'Source' ] ] ,
    toolbarCanCollapse : false,
    width : '100%'
    });
  });
