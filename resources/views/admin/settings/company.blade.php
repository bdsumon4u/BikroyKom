<div class="tab-pane" id="item-1" role="tabpanel">
    <div class="row">
        <div class="col-sm-12">
            <h4><small class="border-bottom mb-1">Company</small></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="company-name">Company Name</label>
                <x-input name="company[name]" id="company-name" :value="$company->name ?? ''" />
                <x-error field="company.name" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="company-email">Company Email</label>
                <x-input name="company[email]" id="company-email" :value="$company->email ?? ''" />
                <x-error field="company.email" />
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="company-phone">Company Phone</label>
                        <x-input name="company[phone]" id="company-phone" :value="$company->phone ?? ''" />
                        <x-error field="company.phone" />
                    </div>
                    <div class="form-group">
                        <label for="company-tagline">Company Tagline</label>
                        <x-input name="company[tagline]" id="company-tagline" :value="$company->tagline ?? ''" />
                        <x-error field="company.tagline" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="company-address">Company Address</label>
                        <x-textarea name="company[address]" id="company-address" rows="4">{{ $company->address ?? '' }}</x-textarea>
                        <x-error field="company.address" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</div>