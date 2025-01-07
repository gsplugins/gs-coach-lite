<template>
	<div class="custom-color-picker">
		<span class="gs-color-reset" title="Clear" @click="clear" v-if="value"><i class="zmdi zmdi-replay"></i></span>
		<label :for="id">
			<input type="color" :name="name" :class="className" :id="id" :value="value" :checked="value" :required="required">
			<span class="input-label">{{ label }}</span>
		</label>
	</div>
</template>

<script>

	require('./color-picker/color-picker.js');

	export default {
		props: {
			name: {
				type: String,
				required: false
			},
			className: {
				type: String,
				required: false
			},
			id: {
				type: String,
				required: false
			},
			value: {
				type: String,
				required: false,
				default: '#fff'
			},
			required: {
				type: Boolean,
				required: false,
				default: false
			},
			label: {
				type: String,
				required: false
			},
		},
		mounted() {
			var that = this;
			this.$input = jQuery(that.$el).find('input');
			
			this.$input.spectrum({
				color: that.value,
				showButtons: false,
				allowEmpty: true,
				showAlpha: true,
				showInput: true,
				preferredFormat: "rgb",
				change: function(color) {
					that.$emit('input', color.toRgbString());
					window.Events.$emit('input-color:manually-changed');
				},
				move: function(color) {
					that.$emit('input', color.toRgbString());
					window.Events.$emit('input-color:manually-changed');
				}
			});
			
			jQuery(that.$el).find('label').on('click', function() {
				that.$input.spectrum("show");
				return false;
			});

			console.log( this.value )
		},
		methods: {
			clear() {
				this.$emit('input', '');
				window.Events.$emit('input-color:manually-changed');
			}
		},
		watch: {
			value() {
				this.$input.spectrum("set", this.value);
			}
		}
	}

</script>