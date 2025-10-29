<script>
    let dataWhen; 
    let actionBeingDone;

    // click on calendar day and show form, fill its date field, focus first field
    document.querySelector('.months').addEventListener('click', function(e) {
        if (!e.target.closest('.day[data-day]') && !e.target.closest('tr.table-entry')) return;
        if (e.target.closest('.day[data-day]')) {
            // show add form
            const clickedDate = e.target.closest('.day[data-day]').dataset.day.split('-').map(x=>x.toString().padStart(2,'0')).join('-');
            location.href = `/planner/add?date=${clickedDate}`;
        } else if (e.target.closest('tr.table-entry')) {
            // show edit form
            setTimeout(() => { /* timeout to be able to catch double click */
                if (actionBeingDone !== 'delete') {
                    const tr = e.target.closest('tr.table-entry');
                    const title = tr.querySelector('td').textContent;
                    const amount = +tr.querySelector('td:nth-child(2)').textContent;
                    const when = tr.querySelector('td:nth-child(3)').getAttribute('title');
                    const entryId = tr.dataset.id;
                    location.href = `/planner/edit/${entryId}`;
                }
                // single click cancelled here
            }, 500)
        }
    })

    // delete entry
    document.querySelector('.months').addEventListener('dblclick', function(e) {
        if (!e.target.closest('tr.table-entry')) return;
        actionBeingDone = 'delete';
        const answer = confirm('Are you sure you want to delete it?\nThis action cannot be undone.');
        if (!answer) return;
        const entryId = e.target.closest('tr.table-entry').dataset.id;
        location.href = '/planner/delete/' + entryId; // not ideal
        // submit delete form
        // const form = document.createElement('form');
        // form.method = 'POST';
        // form.innerHTML = `<input type="hidden" name="_method" value="DELETE">`; // alt to @method('DELETE')
        // const csrf = document.createElement('input');
        // csrf.type = 'hidden';
        // csrf.name = '_token';
        // csrf.value = '{{ csrf_token() }}';
        // form.appendChild(csrf);
        // form.action = `/planner/${entryId}`;
        // document.body.appendChild(form);
        // form.submit();
    })

    // click on red cross btn and hide form, reset all input values in it
    document.querySelector('main').addEventListener('click', function(e) {
        if (!e.target.closest('button[title="Close form"]')) return;
        const mode = document.querySelector('form button').textContent.toLowerCase();
        if (mode === 'add') {
            document.querySelector('.add-edit-form').classList.add('hidden');
            [...document.querySelectorAll('.add-edit-form input')].forEach(x => x.value = '');
        } else {
            location.href = '/planner';
        }
    })

    // hover over tr and highlight calendar day
    document.querySelector('.months').addEventListener('mouseover', function(e) {
        if (!e.target.closest('tr.table-entry')) return;
        dataWhen = e.target.closest('tr.table-entry').dataset.when;
        dataWhen = dataWhen.split('-').map(x => x.length===2 && x[0] === '0' ? x.slice(1) : x).join('-');
        document.querySelector(`.months .day[data-day="${dataWhen}"]`).classList.add('bg-[var(--accent)]', 'text-black');
    })

    // un-hover over tr and de-highlight calendar day
    document.querySelector('.months').addEventListener('mouseout', function(e) {
        if (!e.target.closest('tr.table-entry')) return;
        dataWhen = e.target.closest('tr.table-entry').dataset.when;
        dataWhen = dataWhen.split('-').map(x => x.length===2 && x[0] === '0' ? x.slice(1) : x).join('-');
        document.querySelector(`.months .day[data-day="${dataWhen}"]`).classList.remove('bg-[var(--accent)]', 'text-black');
    })

</script>