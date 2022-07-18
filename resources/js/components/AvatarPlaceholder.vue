<template>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="49.5" :fill="this.fill" />
        <text font-size="46" fill="#FFFFFF" x="50%" y="50%" dy=".1em" style="line-height:1" alignment-baseline="middle" text-anchor="middle" dominant-baseline="central">
            {{ initials }}
        </text>
    </svg>
</template>

<script>
export default {
    name: "AvatarPlaceholder",
    props: {
        fill: {
            type: String,
            default: '#78716C'
        },
        initials: {
            type: String,
            required: true,
        },
    },
}
</script>
