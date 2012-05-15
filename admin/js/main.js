$(document).ready(function()
  {
  $('div.update').click(function()
    {
    $('div.update').fadeOut('slow', function() 
      {
      $('div.update').remove();
      });
    });
  });
