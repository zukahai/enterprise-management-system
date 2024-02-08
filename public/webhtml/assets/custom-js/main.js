var rangePickr = $('.dt-date')
if (rangePickr.length) {
  rangePickr.flatpickr({
    // enableTime: true,
    
    dateFormat: 'Y/m/d',
    locale: {
      weekdays: {
        shorthand: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
        longhand: [
          'Chủ Nhật',
          'Thứ Hai',
          'Thứ Ba',
          'Thứ Tư',
          'Thứ Năm',
          'Thứ Sáu',
          'Thứ Bảy',
        ],
      },
      months: {
        shorthand: [
          'Th01',
          'Th02',
          'Th03',
          'Th04',
          'Th05',
          'Th06',
          'Th07',
          'Th08',
          'Th09',
          'Th10',
          'Th11',
          'Th12',
        ],
        longhand: [
          'Tháng 1',
          'Tháng 2',
          'Tháng 3',
          'Tháng 4',
          'Tháng 5',
          'Tháng 6',
          'Tháng 7',
          'Tháng 8',
          'Tháng 9',
          'Tháng 10',
          'Tháng 11',
          'Tháng 12',
        ],
      },
    },
  });
}
