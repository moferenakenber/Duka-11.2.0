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

function storeVariantForm(data) {
    return {
        store_price: data.store_price,
        store_discount_price: data.store_discount_price,
        store_discount_ends_at: data.store_discount_ends_at,

        seller_price: data.seller_price,
        seller_discount_price: data.seller_discount_price,
        seller_discount_ends_at: data.seller_discount_ends_at,

        customer_price: data.customer_price,
        customer_discount_price: data.customer_discount_price,
        customer_discount_ends_at: data.customer_discount_ends_at,

        status: data.status,

        logAll() {
            console.log('--- Variant Prices & Status ---');
            console.log('Store:', {
                price: this.store_price,
                discount_price: this.store_discount_price,
                discount_ends_at: this.store_discount_ends_at,
            });
            console.log('Seller:', {
                price: this.seller_price,
                discount_price: this.seller_discount_price,
                discount_ends_at: this.seller_discount_ends_at,
            });
            console.log('Customer:', {
                price: this.customer_price,
                discount_price: this.customer_discount_price,
                discount_ends_at: this.customer_discount_ends_at,
            });
            console.log('Status:', this.status);
            console.log('------------------------------');
        }
    }
}


</script>
