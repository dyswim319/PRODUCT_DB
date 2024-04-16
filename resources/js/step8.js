<script>
    let sortColumn = 'id';
    let sortOrder = 'desc';

    document.querySelectorAll('.sortable').forEach(function(th) {
        th.addEventListener('click', function() {
            const column = this.dataset.column;
            if (column === sortColumn) {
                sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
            } else {
                sortColumn = column;
                sortOrder = 'asc';
            }
            fetchDataAndRenderTable();
        });
    });

    function fetchDataAndRenderTable() {
    }
</script>