import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    static targets = ["container"];

    connect() {
        console.log("Modal controller connecté !");
    }

    open(event) {
        event.preventDefault();
        this.containerTarget.classList.remove("hidden");
    }

    close(event) {
        event.preventDefault();
        this.containerTarget.classList.add("hidden");
    }
}