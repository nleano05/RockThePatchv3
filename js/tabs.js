$(document).ready(function()
{
    $('#tabs div.tab-content').hide();
    $('#tabs div.tab-content:first').show();
    $('#tabs ul li:first').addClass('active');
    $('#tabs ul li a').click(function()
    {
        $('#tabs ul li').removeClass('active');
        $(this).parent().addClass('active');
        var currentTab = $(this).attr('href');
        $('#tabs div.tab-content').hide();
        $(currentTab).show();
        return false;
    });
});