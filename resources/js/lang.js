import { usePage } from "@inertiajs/vue3"

export default function __(key, replacements = {}) {
    let translation = usePage().props.translations
    
    const keys = key.split('.')
    keys.forEach(function (keyTmp) {
        translation = translation[keyTmp] ? translation[keyTmp] : key
    })

    Object.keys(replacements).forEach(r => {
        translation = translation.replace(`:${r}`, replacements[r])
    })

    return translation
}