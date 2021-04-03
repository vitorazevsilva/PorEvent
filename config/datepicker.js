$('[data-filter-type="date-range"]').daterangepicker({
    showDropdowns: true,
    ranges: {
        'Hoje': [moment(), moment()],
        'Amanhã': [moment().subtract(-1, 'days'), moment().subtract(-1, 'days')],
        'Esta semana': [moment().startOf('week'), moment().endOf('week')],
        'Semana seguinte': [moment().subtract(-1, 'week').startOf('week'), moment().subtract(-1, 'week').endOf('week')],
        'Este mes': [moment().startOf('month'), moment().endOf('month')],
        'Mês seguinte': [moment().subtract(-1, 'month').startOf('month'), moment().subtract(-1, 'month').endOf('month')],
        'Este ano': [moment().startOf('year'), moment().endOf('year')],
        'Ano seguinte': [moment().subtract(-1, 'year').startOf('year'), moment().subtract(-1, 'year').endOf('year')]
    },
    autoUpdateInput: true,
    applyClass: 'btn-sm btn-secondary',
    cancelClass: 'btn-sm btn-secondary',
    locale: {
        format: 'DD/MM/YYYY',
        applyLabel: 'Aplicar',
        cancelLabel: 'Limpar',
        fromLabel: 'Desde',
        toLabel: 'Até',
        customRangeLabel: 'Selecionar data',
        daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
        monthNames: ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho',
            'julho', 'agosto', 'setembro', 'outubro', 'novembro',
            'dezembro'],
        firstDay: 1
    }
});

