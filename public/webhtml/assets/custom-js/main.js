var rangePickr = $('.dt-date'),
    dateFormat = 'YYYY/MM/DD';

  if (rangePickr.length) {
    rangePickr.flatpickr({
      // enableTime: true,
      dateFormat: 'd/m/Y',
    });
  }
