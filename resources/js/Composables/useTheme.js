import { onMounted, ref } from 'vue'

const useTheme = () => {
    const isDark = ref(false)

    const addDarkTheme = () => {
        document.documentElement.classList.add('dark')
        localStorage.setItem('theme', 'dark')
    }

    const removeDarkTheme = () => {
        document.documentElement.classList.remove('dark')
        localStorage.removeItem('theme')
    }

    const toggleTheme = () => {
        isDark.value = !isDark.value

        isDark.value ? addDarkTheme() : removeDarkTheme()
    }

    onMounted(() => {
        if (localStorage.theme === 'dark') {
            isDark.value = true
            addDarkTheme()

            return false
        }

        removeDarkTheme()
    })

    return {
        isDark,
        toggleTheme
    }
}

export default useTheme