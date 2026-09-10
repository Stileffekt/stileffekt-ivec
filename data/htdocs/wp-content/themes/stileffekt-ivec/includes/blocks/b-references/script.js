{
    const blocks = document.querySelectorAll('.b-references');

    if (blocks) {

        blocks.forEach(function (block) {

            const industries = new Choices('#industries', {
                searchEnabled: true,
                removeItemButton: true,
            });

            const areas = new Choices('#areas', {
                searchEnabled: true,
                removeItemButton: true,
            });

            const interfaces = new Choices('#interfaces', {
                searchEnabled: true,
                removeItemButton: true,
            });


            function filterReferences() {
                const valsIndustries = industries.getValue(true);
                const valsAreas = areas.getValue(true);
                const valsInterfaces = interfaces.getValue(true);

                let itemsVisible = false;

                document.querySelectorAll('.c-reference').forEach(ref => {
                    const termsIndustries = (ref.dataset.industries || '').split(',');
                    const termsAreas = (ref.dataset.areas || '').split(',');
                    const termsInterfaces = (ref.dataset.interfaces || '').split(',');

                    const matchesIndustries = valsIndustries.length === 0 || valsIndustries.some(v => termsIndustries.includes(v));
                    const matchesAreas = valsAreas.length === 0 || valsAreas.some(v => termsAreas.includes(v));
                    const matchesInterfaces = valsInterfaces.length === 0 || valsInterfaces.some(v => termsInterfaces.includes(v));

                    const visible = matchesIndustries && matchesAreas && matchesInterfaces;
                    ref.style.display = visible ? '' : 'none';

                    if (visible) itemsVisible = true
                });

                let noResults = document.querySelector('#no-results-message');
                if (!noResults) {
                    noResults = document.createElement('div');
                    noResults.id = 'no-results-message';
                    noResults.textContent = 'Keine Ergebnisse gefunden.';
                    document.querySelector('.c-references').appendChild(noResults);
                }
                noResults.style.display = itemsVisible ? 'none' : 'block';

            }

            ['industries', 'areas', 'interfaces'].forEach(id => {
                const select = document.querySelector('#' + id);
                select.addEventListener('addItem', filterReferences);
                select.addEventListener('removeItem', filterReferences);
            });

            filterReferences();

        })
    }
}