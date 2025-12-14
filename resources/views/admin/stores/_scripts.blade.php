<script>
function storeVariantForm() {
    return {
        variants: [],
        addVariant() {
            this.variants.push({
                item_color_id: '',
                item_size_id: '',
                item_packaging_type_id: '',
                price: 0,
                discount_price: 0,
                store_stock: 0,
                capacityText: '',
                packagingQuantity: 1,
                totalPieces: 1,
                is_active: true,
                image: null,
                barcode: ''
            });
        },
        removeVariant(index) {
            this.variants.splice(index, 1);
        },
        updateCapacity(index, event) {
            const selectedOption = event.target.selectedOptions[0];
            const baseQty = parseInt(selectedOption.dataset.quantity) || 1;
            this.variants[index].packagingQuantity = baseQty;
            this.variants[index].totalPieces = baseQty;
            this.variants[index].capacityText = `(${this.variants[index].totalPieces} pcs)`;
        },
        handleImageUpload(index, event) {
            this.variants[index].image = event.target.files[0];
        },
        imagePreview(file) {
            if (!file) return '';
            return URL.createObjectURL(file);
        }
    }
}
</script>
