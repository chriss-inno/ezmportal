  <!-- Bootstrap -->
{!!HTML::style("css/bootstrap.min.css")!!}
{!!HTML::style("css/bootstrap-reset.css")!!}

<style type="text/css">
    .page
    {
        page-break-after: always;
        page-break-inside: avoid;
    }
</style>

@foreach($pages as $page)
    <div class="page">
        <?php echo  $page; ?>
    </div>
@endforeach