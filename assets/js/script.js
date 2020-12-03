new Vue({
  el: '#app',
  data: {
    labels: {
      expand: 'Hepsini Aç',
      collapse: 'Hepsini Kapat' },

    accordions: {
      'S1': { isOpen: false },
      'S2': { isOpen: false },
      'S3': { isOpen: false },
      'S4': { isOpen: false },
      'S5': { isOpen: false },
      'S6': { isOpen: false },
      'S7': { isOpen: false },
      'S8': { isOpen: false },
      'S9': { isOpen: false },
      'S10': { isOpen: false },
      'S11': { isOpen: false },
      'S12': { isOpen: false },
      'S13': { isOpen: false },
      'S14': { isOpen: false },
      'S15': { isOpen: false },
      'S16': { isOpen: false },
      'S17': { isOpen: false },
      'S18': { isOpen: false },
      'S19': { isOpen: false },
      'S20': { isOpen: false },
      'S21': { isOpen: false },
      'S22': { isOpen: false },
      'S23': { isOpen: false },
      'S24': { isOpen: false },
      'S25': { isOpen: false },
      'S26': { isOpen: false },
      'S27': { isOpen: false },
      'S28': { isOpen: false },
      'S29': { isOpen: false },
      'S30': { isOpen: false },
      'S31': { isOpen: false },
      'S32': { isOpen: false },
      'S33': { isOpen: false },
      'S34': { isOpen: false },
      'S35': { isOpen: false },
      'S36': { isOpen: false } } },


  computed: {
    toggleAllLabel() {
      return this.showCollapseAll ?
      this.labels.collapse :
      this.labels.expand;
    },
    areAllAccordionsOpen() {
      return Object.keys(this.accordions).
      every(key => this.accordions[key].isOpen);
    },
    showCollapseAll() {
      return this.areAllAccordionsOpen;
    },
    showExpandAll() {
      return this.showCollapseAll === false;
    } },

  methods: {
    toggleAll() {
      const newIsOpen = this.showExpandAll;
      Object.keys(this.accordions).
      forEach(key => {
        this.accordions[key].isOpen = newIsOpen;
      });
    },
    toggleAccordion(label) {
      const accordion = this.accordions[label];

      if (accordion) {
        accordion.isOpen = !accordion.isOpen;
      } else {
        console.error(`Could not find accordion '${label}'`);
      }
    },
    isOpen(label) {
      const accordion = this.accordions[label];
      return accordion ? accordion.isOpen : false;
    } } });