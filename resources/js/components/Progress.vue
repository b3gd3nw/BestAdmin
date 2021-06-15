<template>
    <section>
        <b-progress :value="20"></b-progress>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                indeterminate: false,
                type: null,
                size: 'is-medium',
                showValue: true,
                format: 'raw',
                precision: 2,
                keepTrailingZeroes: false,
                locale: undefined // Browser locale
            }
        }
    }
</script>