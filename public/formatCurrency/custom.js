// $('.price').formatCurrency({
//     region: 'vi-VN',
//     roundToDecimalPlace:3,
// });
$('.price').formatCurrency({
    symbol: '₫',
    positiveFormat: '%n %s',
    negativeFormat: '-%n %s',
    decimalSymbol: '.',
    digitGroupSymbol: ',',
    groupDigits: true,
    roundToDecimalPlace:3,
});
$('.price-lite').formatCurrency({
    symbol: '',
    positiveFormat: '%n %s',
    negativeFormat: '-%n %s',
    decimalSymbol: '.',
    digitGroupSymbol: ',',
    groupDigits: true,
    roundToDecimalPlace:3,
});
