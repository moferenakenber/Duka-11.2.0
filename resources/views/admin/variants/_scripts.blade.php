<script>
function variantForm() {
    return {
        variants: [],
        addVariant() {
            this.variants.push({
                item_color_id: '',
                item_size_id: '',
                item_packaging_type_id: '',
                price: 0,
                capacityText: '',
                packagingQuantity: 1,
                totalPieces: 1,
                is_active: true,
                image: null,
                barcode: ''
            });
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
        }
    }
}

function variantFileUpload(variantIndex) {
    return {
        images: [],
        uploading: false,
        progress: 0,
        done: false,

        imageUrl(path) {
            return "{{ asset('') }}" + path;
        },

        uploadFiles(event) {
            this.uploading = true;
            this.done = false;
            this.progress = 0;

            let formData = new FormData();
            let files = event.target.files;

            for (let i = 0; i < files.length; i++) {
                formData.append('variant_images[]', files[i]);
            }

            axios.post("{{ route('admin.variants.uploadImages') }}", formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                onUploadProgress: (e) => {
                    if (e.lengthComputable) {
                        this.progress = Math.round((e.loaded * 100) / e.total);
                    }
                }
            })
            .then((res) => {
                this.images = res.data.paths;
                this.uploading = false;
                this.done = true;
            })
            .catch(err => {
                this.uploading = false;
                alert('Image upload failed');
            });
        }
    }
}
</script>
