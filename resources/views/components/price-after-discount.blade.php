<div class="col-md-12 mt-3">
    {{-- <x-form-label field="price_after_discount" /> --}}
    <x-form-label filed="price_after_discount" />

<input type="number" id="price_after_discount" name="price_after_discount" class="form-control" readonly
    placeholder="{{ __('keywords.price_after_discount') }}">
</div>

<script>
document.getElementById('price').addEventListener('input', calculatePriceAfterDiscount);
document.getElementById('discount').addEventListener('input', calculatePriceAfterDiscount);

function calculatePriceAfterDiscount() {
    const price = parseFloat(document.getElementById('price').value) || 0;
    const discount = parseFloat(document.getElementById('discount').value) || 0;

    if (price >= 0 && discount >= 0 && discount <= 100) {
        const priceAfterDiscount = price - (price * discount / 100);
        document.getElementById('price_after_discount').value = priceAfterDiscount.toFixed(2);
    } else {
        document.getElementById('price_after_discount').value = '';
    }
}
</script>
