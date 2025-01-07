<template>

	<div class="custom-toggle-button--wrapper" :class="{ 'is-checked': value }">
		<div class="custom-toggle-button" :class="{ 'is-checked': value }">
			<label :for="id">
				<input type="checkbox" :name="name" :id="id" :value="value" :checked="value" :required="required" @change="updateInput">
			</label>
		</div>
		<span class="custom-toggle--status" v-if="offLabel && ! value">{{offLabel}}</span>
		<span class="custom-toggle--status" v-if="onLabel && value">{{onLabel}}</span>
	</div>

</template>

<script>
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
		offLabel: {
			type: String,
			required: false,
		},
		onLabel: {
			type: String,
			required: false,
		},
		id: {
			type: String,
			required: false
		},
		value: {
			type: Boolean,
			required: false,
			default: false
		},
		required: {
			type: Boolean,
			required: false,
			default: false
		},
	},
	methods: {
		updateInput: function(event) {
			this.$emit('input', event.target.checked);
		}
	}
}
</script>
